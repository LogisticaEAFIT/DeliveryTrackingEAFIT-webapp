<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Http\Controllers;

use App\Exports\VehicleTypesExport;
use App\Http\Controllers\Controller;
use App\Imports\VehicleTypesImport;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Warehouse;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class VehicleTypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {

            if (Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin" ||
            Auth::user()->getRole()=="warehouse_admin") {
                return $next($request);
            }
            return redirect()->route('home.index');
        });
    }

    public function show($id)
    {
        $data = []; //to be sent to the view
        
        try {
            $vehicle_type = VehicleType::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('home.index');
        }

        $data["vehicle_type"] = $vehicle_type;

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('vehicle_type.title_list'), "vehicle_type.list", null, "0");
        $breadlist[2] = array($data["vehicle_type"]->getId(), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('vehicle_type.show')->with("data", $data);
    }
    
    public function list()
    {
        $data = []; //to be sent to the view
        $data["title"] = __('vehicle_type.title');
        $data["vehicle_types"] = VehicleType::orderBy('id')->paginate(5);

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('vehicle_type.title_list'), "", null, "1");
        $data['breadlist'] = $breadlist;
       
        return view('vehicle_type.list')->with("data", $data);
    }

    public function create()
    {
        $data = []; //to be sent to the view
        $data["title"] = __('vehicle_type.title');
        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('vehicle_type.title_create'), "", null, "1");
        $data['breadlist'] = $breadlist;
        
        return view('vehicle_type.create')->with("data", $data);
    }
    
    public function update(Request $request)
    {
        $data = [];
        $data["title"] = __('vehicle_type.title');

        try {
            $vehicle_type = VehicleType::findOrFail($request->input('id'));
        } catch (Exception $e) {
            return redirect()->route('vehicle_type.list');
        }

        $data["vehicle_type"] = $vehicle_type;

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('vehicle_type.title_list'), "vehicle_type.list", null, "0");
        $breadlist[2] = array($data['vehicle_type']->getId(), "vehicle_type.show",
                        ['id'=>$data['vehicle_type']->getId()], "0");
        $breadlist[3] = array(__('vehicle_type.title_update'), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('vehicle_type.update')->with("data", $data);
    }

    public function updateSave(Request $request)
    {
        VehicleType::validate($request);

        VehicleType::where('id', $request->input('id'))->update([
            'capacity' => $request->input('capacity'),
            'description' => $request->input('description'),
            'volume' => $request->input('volume'),
        ]);

        return redirect()->route('vehicle_type.list');
    }
    
    public function save(Request $request)
    {
        VehicleType::validate($request);

        VehicleType::create([
            'capacity' => $request->input('capacity'),
            'description' => $request->input('description'),
            'volume' =>$request->input('volume'),
        ]);

        return redirect()->route('vehicle_type.list')->with('success', __('vehicle_type.succesful'));
    }

    public function delete(Request $request)
    {
        $vehicle_type = VehicleType::find($request['id']);
        $vehicle_type->setIsActive('0');
        $vehicle_type->save();
        return redirect()->route('vehicle_type.list');
    }

    public function reactivate(Request $request)
    {
        $vehicle_type = VehicleType::find($request['id']);
        $vehicle_type->setIsActive('1');
        $vehicle_type->save();
        return redirect()->route('vehicle_type.list');
    }

    public function importExport()
    {
        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('vehicle_type.title_import_export'), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('vehicle_type.import_export')->with("data", $data);
    }

    public function importFile(Request $request)
    {
        try {
            Excel::import(new VehicleTypesImport, $request->file('file')->store('temp'));
        } catch (Exception $e) {
            return redirect()->route('vehicle_type.import_export')->withErrors(__('vehicle_type.error.wrong_format'));
        }
        
        return redirect()->route('vehicle_type.list');
    }

    public function exportFile()
    {
        return Excel::download(new VehicleTypesExport, 'vehicle-types-list.xlsx');
    }

    public function downloadFormat()
    {
        $filename = "/csv/vehicle_type_sample.csv";
        $file=public_path().$filename;
        
        $headers = [
            'Content-Type' => 'application/csv',
        ];

        return response()->download($file, 'vehicle_type_sample.csv', $headers);
    }
}
