<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Http\Controllers;

use App\Exports\VehiclesExport;
use App\Http\Controllers\Controller;
use App\Imports\VehiclesImport;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Warehouse;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class VehicleController extends Controller
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
            $vehicle = Vehicle::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('home.index');
        }

        $data["vehicle"] = $vehicle;
        return view('vehicle.show')->with("data", $data);
    }
    
    public function list()
    {
        $data = []; //to be sent to the view
        $data["title"] = __('vehicle.title');

        if (Auth::user()->getRole()=="super_admin") {
            $data["vehicles"] = Vehicle::orderBy('id')->get();
        } elseif (Auth::user()->getRole()=="company_admin") {
            $ids = [];
            foreach (Auth::user()->company->warehouses as $warehouse) {
                array_push($ids, $warehouse->getId());
            }
            $data["vehicles"] = Vehicle::whereIn('warehouse_id', $ids)->orderBy('id')->get();
        } elseif (Auth::user()->getRole()=="warehouse_admin") {
            $data["vehicles"] = Vehicle::where('warehouse_id', Auth::user()->getWarehouseId())
                                        ->orderBy('id')->get();
        }

        return view('vehicle.list')->with("data", $data);
    }

    public function create()
    {
        $data = []; //to be sent to the view
        $data["title"] = __('vehicle.title');
        //$data["warehouses"] = Warehouse::all();
        $data["warehouses"] = Warehouse::orderBy('id')->get();
        if (empty($data["warehouses"]->toArray())) {
            return redirect()->route('warehouse.create')->withErrors(__('warehouse.create_warehouse'));
        }
        $data["vehicle_types"] = VehicleType::orderBy('id')->get();
        if (empty($data["vehicle_types"]->toArray())) {
            return redirect()->route('vehicle_type.create')->withErrors(__('vehicle_type.create_vehicle_type'));
        }
        return view('vehicle.create')->with("data", $data);
    }
    
    public function update(Request $request)
    {
        $data = [];
        $data["title"] = __('vehicle.title');

        try {
            $vehicle = Vehicle::findOrFail($request->input('id'));
        } catch (Exception $e) {
            return redirect()->route('vehicle.list');
        }

        $data["vehicle"] = $vehicle;

        return view('vehicle.update')->with("data", $data);
    }

    public function updateSave(Request $request)
    {
        Vehicle::validate($request);

        Vehicle::where('id', $request->input('id'))->update([
            'name' => $request->input('name'),
            'observations' => $request->input('observations'),
        ]);

        return redirect()->route('vehicle.list');
    }
    
    public function save(Request $request)
    {
        Vehicle::validate($request);

        Vehicle::create([
            'name' => $request->input('name'),
            'observations' => $request->input('observations'),
            'warehouse_id' =>$request->input('warehouse_id'),
            'type_id' => $request->input('type_id'),
        ]);

        return redirect()->route('vehicle.list')->with('success', __('vehicle.succesful'));
    }

    public function delete(Request $request)
    {
        $vehicle = Vehicle::find($request['id']);
        $vehicle->setIsActive('0');
        $vehicle->save();
        return redirect()->route('vehicle.list');
    }

    public function importExport()
    {
        return view('vehicle.import_export');
    }

    public function importFile(Request $request)
    {
        Excel::import(new VehiclesImport, $request->file('file')->store('temp'));
        return back();
    }

    public function exportFile()
    {
        return Excel::download(new VehiclesExport, 'vehicles-list.xlsx');
    }
}
