<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use App\Exports\VehiclesExport;
use App\Http\Controllers\Controller;
use App\Imports\CustomersImport;
use App\Imports\VehiclesImport;
use App\Models\Company;
use App\Models\Customer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Warehouse;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {

            if (Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin") {
                return $next($request);
            }
            return redirect()->route('home.index');
        });
    }

    public function show($id)
    {
        $data = []; //to be sent to the view
        
        try {
            $customer = Customer::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('home.index');
        }

        $data["customer"] = $customer;

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        if (Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin") {
            $breadlist[1] = array(__('customer.title_list'), "customer.list", null, "0");
            $breadlist[2] = array($data["customer"]->getName(), "", null, "1");
        }
        $data['breadlist'] = $breadlist;

        return view('customer.show')->with("data", $data);
    }
    
    public function list()
    {
        $data = []; //to be sent to the view
        $data["title"] = __('customer.title');

        if (Auth::user()->getRole()=="super_admin") {
            $data["customers"] = Customer::orderBy('id')->with('company')->paginate(5);
        } elseif (Auth::user()->getRole()=="company_admin") {
            $data["customers"] = Customer::where('company_id', Auth::user()->getCompanyId())
                                        ->orderBy('id')->with('company')->paginate(5);
        }

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('customer.title_list'), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('customer.list')->with("data", $data);
    }

    public function create()
    {
        $data = []; //to be sent to the view
        $data["title"] = __('customer.title');
        $data["companies"] = Company::orderBy('id')->get();
        if (empty($data["companies"]->toArray())) {
            return redirect()->route('company.create')->withErrors(__('company.create_company'));
        }

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('customer.title_create'), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('customer.create')->with("data", $data);
    }
    
    public function update(Request $request)
    {
        $data = [];
        $data["title"] = __('customer.title');

        try {
            $customer = Customer::findOrFail($request->input('id'));
        } catch (Exception $e) {
            return redirect()->route('customer.list');
        }

        $data["customer"] = $customer;

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        if (Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin") {
            $breadlist[1] = array(__('customer.title_list'), "customer.list", null, "0");
            $breadlist[2] = array($data["customer"]->getName(), "customer.show",
                            ['id'=>$data['customer']->getId()], "0");
            $breadlist[3] = array(__('customer.title_update'), "", null, "1");
        }
        $data['breadlist'] = $breadlist;

        return view('customer.update')->with("data", $data);
    }

    public function updateSave(Request $request)
    {
        Customer::validate($request);

        Customer::where('id', $request->input('id'))->update([
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'observations' => $request->input('observations'),
        ]);

        return redirect()->route('customer.list');
    }
    
    public function save(Request $request)
    {
        Customer::validate($request);

        $phone_number = "+" . $request->input('phone_number_prefix') . " " . $request->input('phone_number');

        Customer::create([
            'name' => $request->input('name'),
            'phone_number' => $phone_number,
            'address' => $request->input('address'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'observations' => $request->input('observations'),
            'company_id' => $request->input('company_id'),
        ]);

        return redirect()->route('customer.list')->with('success', __('customer.succesful'));
    }

    public function delete(Request $request)
    {
        $customer = Customer::find($request['id']);
        $customer->setIsActive('0');
        $customer->save();
        return redirect()->route('customer.list');
    }

    public function reactivate(Request $request)
    {
        $customer = Customer::find($request['id']);
        $customer->setIsActive('1');
        $customer->save();
        return redirect()->route('customer.list');
    }

    public function importExport()
    {
        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('customer.title_import_export'), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('customer.import_export')->with("data", $data);
    }

    public function importFile(Request $request)
    {
        try {
            Excel::import(new CustomersImport, $request->file('file')->store('temp'));
        } catch (Exception $e) {
            return redirect()->route('customer.import_export')->withErrors(__('customer.error.wrong_format'));
        }
        
        return redirect()->route('customer.list');
    }

    public function exportFile()
    {
        return Excel::download(new CustomersExport, 'customers-list.xlsx');
    }

    public function downloadFormat()
    {
        $filename = "/csv/customer_sample.csv";
        $file=public_path().$filename;
        
        $headers = [
            'Content-Type' => 'application/csv',
        ];

        return response()->download($file, 'customer_sample.csv', $headers);
    }
}
