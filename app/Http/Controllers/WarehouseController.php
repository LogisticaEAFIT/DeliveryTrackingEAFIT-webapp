<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Warehouse;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class WarehouseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {

            if (Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin") {
                return $next($request);
            } elseif (Auth::user()->getRole()=="warehouse_admin" &&
                $request->route('id') == Auth::user()->getWarehouseId()) {
                return $next($request);
            } elseif (Auth::user()->getRole()=="warehouse_admin" &&
                $request->input('id') == Auth::user()->getWarehouseId()) {
                return $next($request);
            }
            return redirect()->route('home.index');
        });
    }

    public function show($id)
    {
        $data = []; //to be sent to the view
        
        try {
            $warehouse = Warehouse::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('home.index');
        }

        $data["warehouse"] = $warehouse;
        return view('warehouse.show')->with("data", $data);
    }
    
    public function list()
    {
        $data = []; //to be sent to the view
        $data["title"] = __('warehouse_list.title');

        if (Auth::user()->getRole()=="super_admin") {
            $data["warehouses"] = Warehouse::orderBy('id')->get();
        } else {
            $data["warehouses"] = Warehouse::where('company_id', Auth::user()->getCompanyId())->orderBy('id')->get();
        }

        return view('warehouse.list')->with("data", $data);
    }

    public function create()
    {
        $data = []; //to be sent to the view
        $data["title"] = __('warehouse_create.title');
        $data["companies"] = Company::all();
        if (empty($data["companies"]->toArray())) {
            return redirect()->route('company.create')->withErrors(__('warehouse.create_company'));
            ;
        }
        return view('warehouse.create')->with("data", $data);
    }
    
    public function update(Request $request)
    {
        $data = [];
        $data["title"] = __('warehouse_update.title');

        try {
            $warehouse = Warehouse::findOrFail($request->input('id'));
        } catch (Exception $e) {
            return redirect()->route('warehouse.list');
        }

        $data["warehouse"] = $warehouse;

        return view('warehouse.update')->with("data", $data);
    }

    public function updateSave(Request $request)
    {

        Warehouse::where('id', $request->input('id'))->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'address' => $request->input('address'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        return redirect()->route('warehouse.list');
    }
    
    public function save(Request $request)
    {
        Warehouse::validate($request);

        Warehouse::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'address' => $request->input('address'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'company_id' => $request->input('company_id'),
        ]);

        return redirect()->route('warehouse.list')->with('success', __('warehouse_create.succesful'));
    }

    public function delete(Request $request)
    {
        $warehouse = Warehouse::find($request['id']);
        $warehouse->setIsActive('0');
        $warehouse->save();
        return redirect()->route('warehouse.list');
    }
}
