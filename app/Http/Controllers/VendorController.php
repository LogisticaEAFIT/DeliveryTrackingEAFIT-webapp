<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Http\Controllers;

use App\Exports\CompaniesExport;
use App\Exports\VendorsExport;
use App\Http\Controllers\Controller;
use App\Imports\CompaniesImport;
use App\Imports\VendorsImport;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Company;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {

            if (Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin" ||
            Auth::user()->getRole()=="warehouse_admin" ||
            Auth::user()->getRole()=="courier") {
                return $next($request);
            }
            return redirect()->route('home.index');
        });
    }

    public function show($id)
    {
        $data = []; //to be sent to the view
        
        try {
            $vendor = Vendor::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('home.index');
        }

        $data["title"] = $vendor->getName();
        $data["vendor"] = $vendor;

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('vendor.title_list'), "vendor.list", null, "0");
        $breadlist[2] = array($data["vendor"]->getName(), "", null, "1");
        $data['breadlist'] = $breadlist;


        return view('vendor.show')->with("data", $data);
    }
    
    public function list()
    {
        $data = []; //to be sent to the view
        $data["title"] = __('vendor.title');
        $data["vendors"] = Vendor::orderBy('id')->paginate(5);

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('vendor.title_list'), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('vendor.list')->with("data", $data);
    }

    public function create()
    {
        $data = []; //to be sent to the view
        $data["title"] = __('vendor.title');
        $data["companies"] = Company::all();
        if (empty($data["companies"]->toArray())) {
            return redirect()->route('company.create')->withErrors(__('vendor.create_company'));
        }

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('vendor.title_create'), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('vendor.create')->with("data", $data);
    }
    
    public function update(Request $request)
    {
        $data = [];
        $data["title"] = __('vendor.title');

        try {
            $vendor = Vendor::findOrFail($request->input('id'));
        } catch (Exception $e) {
            return redirect()->route('vendor.list');
        }

        $data["vendor"] = $vendor;

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('vendor.title_list'), "vendor.list", null, "0");
        $breadlist[2] = array($data["vendor"]->getName(), "vendor.show", ['id'=>$data['vendor']->getId()], "0");
        $breadlist[3] = array(__('vendor.title_update'), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('vendor.update')->with("data", $data);
    }

    public function updateSave(Request $request)
    {
        Vendor::validate($request);

        Vendor::where('id', $request->input('id'))->update([
            'name' => $request->input('name'),
            'contact_info' => $request->input('contact_info'),
        ]);

        return redirect()->route('vendor.list');
    }
    
    public function save(Request $request)
    {
        Vendor::validate($request);

        Vendor::create([
            'name' => $request->input('name'),
            'contact_info' => $request->input('contact_info'),
            'company_id' => $request->input('company_id'),
        ]);

        return redirect()->route('vendor.list');
    }

    public function delete(Request $request)
    {
        $vendor = Vendor::find($request['id']);
        $vendor->setIsActive('0');
        $vendor->save();
        return redirect()->route('vendor.list');
    }

    public function reactivate(Request $request)
    {
        $vendor = Vendor::find($request['id']);
        $vendor->setIsActive('1');
        $vendor->save();
        return redirect()->route('vendor.list');
    }

    public function importExport()
    {
        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('vendor.title_import_export'), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('vendor.import_export')->with("data", $data);
    }

    public function importFile(Request $request)
    {
        try {
            Excel::import(new VendorsImport, $request->file('file')->store('temp'));
        } catch (Exception $e) {
            return redirect()->route('vendor.import_export')->withErrors(__('vendor.error.wrong_format'));
        }
        
        return redirect()->route('vendor.list');
    }

    public function exportFile()
    {
        return Excel::download(new VendorsExport, 'vendors-list.xlsx');
    }

    public function downloadFormat()
    {
        $filename = "/csv/vendor_sample.csv";
        $file=public_path().$filename;
        
        $headers = [
            'Content-Type' => 'application/csv',
        ];

        return response()->download($file, 'vendor_sample.csv', $headers);
    }
}
