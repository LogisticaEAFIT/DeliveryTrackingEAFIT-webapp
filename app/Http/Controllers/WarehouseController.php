<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Warehouse;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Exception;

class WarehouseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->getRole()=="courier"){
                return redirect()->route('home.index');
            }
            return $next($request);
        });
    }

    public function show($id)
    {
        $data = []; //to be sent to the view
        
        try{
            $warehouse = Warehouse::findOrFail($id);
        }catch(Exception $e){
            return redirect()->route('home.index');
        }

        $data["warehouse"] = $warehouse;
        return view('warehouse.show')->with("data",$data);
    }
    
    public function list()
    {
        $data = []; //to be sent to the view
        $data["title"] = __('warehouse_list.title');
        $data["warehouses"] = Warehouse::orderBy('id')->get();

        return view('warehouse.list')->with("data",$data);

    }

    public function create()
    {
        $data = []; //to be sent to the view
        $data["title"] = __('warehouse_create.title');
        $data["companies"] = Company::all();
        if (empty($data["companies"]->toArray())) {
            return redirect()->route('company.create')->withErrors(__('warehouse.create_company'));;
        }
        return view('warehouse.create')->with("data",$data);

    }
    
    public function update(Request $request)
    {
        $data = [];
        $data["title"] = __('warehouse_update.title');

        try{
            $warehouse = Warehouse::findOrFail($request->input('id'));
        }catch(Exception $e){
            return redirect()->route('warehouse.list');
        }

        $data["warehouse"] = $warehouse;

        return view('warehouse.update')->with("data", $data);
    }

    public function updateSave(Request $request){
        $warehouse = Warehouse::findOrFail($request->input('id'));

        if($warehouse->getDescription() != $request->input('description')){
            $warehouse->setDescription($request->input('description'));
        }
        if($warehouse->getAddress() != $request->input('address')){
            $warehouse->setAddress($request->input('address'));
        }if($warehouse->getLatitude() != $request->input('latitude')){
            $warehouse->setLatitude($request->input('latitude'));
        }
        if($warehouse->getLongitude() != $request->input('longitude')){
            $warehouse->setLongitude($request->input('longitude'));
        }

        $warehouse->save();

        return back()->with('success', __('warehouse_update.succesful'));

    }
    
    public function save(Request $request)
    {
        Warehouse::validate($request);

        $warehouse = new Warehouse();
        $warehouse->setDescription($request->input('description'));
        $warehouse->setAddress($request->input('address'));
        $warehouse->setLatitude($request->input('latitude'));
        $warehouse->setLongitude($request->input('longitude'));
        $warehouse->setCompanyId($request->input('company_id'));
        $warehouse->save();

        return redirect()->route('warehouse.list')->with('success', __('warehouse_create.succesful'));
    }

    public function delete(Request $request){
        $warehouse = Warehouse::find($request['id']);
        $warehouse->delete();
        return redirect()->route('warehouse.list');
    }

}