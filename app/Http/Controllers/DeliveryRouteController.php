<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Warehouse;
use App\Models\DeliveryRoute;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class DeliveryRouteController extends Controller
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
            $delivery_route = DeliveryRoute::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('home.index');
        }

        $data["delivery_route"] = $delivery_route;
        return view('delivery_route.show')->with("data", $data);
    }
    
    public function list()
    {
        $data = []; //to be sent to the view
        $data["title"] = __('delivery_route.title');

        if (Auth::user()->getRole()=="super_admin") {
            $data["delivery_routes"] = DeliveryRoute::orderBy('id')->get();
        } elseif (Auth::user()->getRole()=="company_admin") {
            $ids = [];
            foreach (Auth::user()->company->warehouses as $warehouse) {
                array_push($ids, $warehouse->getId());
            }
            $data["delivery_routes"] = DeliveryRoute::whereIn('warehouse_id', $ids)->orderBy('id')->get();
        } elseif (Auth::user()->getRole()=="warehouse_admin") {
            $data["delivery_routes"] = DeliveryRoute::where('warehouse_id', Auth::user()->getWarehouseId())
                                        ->orderBy('id')->get();
        }

        return view('delivery_route.list')->with("data", $data);
    }

    public function create()
    {
        $data = []; //to be sent to the view
        $data["title"] = __('delivery_route.title');
        //$data["warehouses"] = Warehouse::all();
        $data["couriers"] = User::where('role', 'courier')->get();
        if (empty($data["couriers"]->toArray())) {
            return redirect()->route('user.create')->withErrors(__('user.create_courier'));
            ;
        }
        return view('delivery_route.create')->with("data", $data);
    }
    
    public function update(Request $request)
    {
        $data = [];
        $data["title"] = __('delivery_route.title');

        try {
            $delivery_route = DeliveryRoute::findOrFail($request->input('id'));
        } catch (Exception $e) {
            return redirect()->route('delivery_route.list');
        }

        $data["delivery_route"] = $delivery_route;

        return view('delivery_route.update')->with("data", $data);
    }

    public function updateSave(Request $request)
    {
        DeliveryRoute::validate($request);

        DeliveryRoute::where('id', $request->input('id'))->update([
            'date' => $request->input('date'),
            'completed_deliveries' => $request->input('completed_deliveries'),
            'number_of_deliveries' => $request->input('number_of_deliveries'),
        ]);

        return redirect()->route('delivery_route.list');
    }
    
    public function save(Request $request)
    {
        DeliveryRoute::validate($request);

        $splited_info = explode('-', $request->input('courier_id'));
        $data = [];
        $data['warehouse_id'] = $splited_info[0];
        $data['courier_id'] = $splited_info[1];

        DeliveryRoute::create([
            'date' => $request->input('date'),
            'completed_deliveries' => $request->input('completed_deliveries'),
            'number_of_deliveries' => $request->input('number_of_deliveries'),
            'warehouse_id' => $data['warehouse_id'],
            'courier_id' => $splited_info[1],
        ]);

        return redirect()->route('delivery_route.list')->with('success', __('delivery_route.succesful'));
    }

    public function delete(Request $request)
    {
        $delivery_route = DeliveryRoute::find($request['id']);
        $delivery_route->setState('finished');
        $delivery_route->save();
        return redirect()->route('delivery_route.list');
    }
}
