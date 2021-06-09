<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Http\Controllers;

use App\Exports\DeliveryRoutesExport;
use App\Http\Controllers\Controller;
use App\Imports\DeliveryRoutesImport;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Warehouse;
use App\Models\DeliveryRoute;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class DeliveryRouteController extends Controller
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
            $delivery_route = DeliveryRoute::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('home.index');
        }

        $data["delivery_route"] = $delivery_route;
        $data["services"] = $delivery_route->services;
        //dd($data["services"]);

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        if (Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin"
        || Auth::user()->getRole()=="warehouse_admin") {
            $breadlist[1] = array(__('delivery_route.title_list'), "delivery_route.list", null, "0");
            $breadlist[2] = array($data["delivery_route"]->getId(), "", null, "1");
        } else {
            $breadlist[1] = array($data["delivery_route"]->getId(), "", null, "1");
        }
        $data['breadlist'] = $breadlist;

        return view('delivery_route.show')->with("data", $data);
    }
    
    public function list()
    {
        $data = []; //to be sent to the view
        $data["title"] = __('delivery_route.title');

        if (Auth::user()->getRole()=="super_admin") {
            $data["delivery_routes"] = DeliveryRoute::orderBy('id')->with('warehouse')
                                        ->with('courier')->with('vehicle')->paginate(5);
        } elseif (Auth::user()->getRole()=="company_admin") {
            $ids = [];
            foreach (Auth::user()->company->warehouses as $warehouse) {
                array_push($ids, $warehouse->getId());
            }
            $data["delivery_routes"] = DeliveryRoute::whereIn('warehouse_id', $ids)
                                        ->orderBy('id')->with('warehouse')->with('courier')
                                        ->with('vehicle')->paginate(5);
        } elseif (Auth::user()->getRole()=="warehouse_admin") {
            $data["delivery_routes"] = DeliveryRoute::where('warehouse_id', Auth::user()->getWarehouseId())
                                        ->orderBy('id')->with('warehouse')->with('courier')
                                        ->with('vehicle')->paginate(5);
        } elseif (Auth::user()->getRole()=="courier") {
            $data["delivery_routes"] = DeliveryRoute::where('courier_id', Auth::user()->getId())
                                        ->orderBy('id')->with('warehouse')->with('courier')
                                        ->with('vehicle')->paginate(5);
        }

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('delivery_route.title_list'), "", null, "1");
        $data['breadlist'] = $breadlist;

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
        }
        $data["vehicles"] = Vehicle::orderBy('id')->get();
        if (empty($data["vehicles"]->toArray())) {
            return redirect()->route('vehicle.create')->withErrors(__('vehicle.create_vehicle'));
        }

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('delivery_route.title_create'), "", null, "1");
        $data['breadlist'] = $breadlist;

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

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        if (Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin"
        || Auth::user()->getRole()=="warehouse_admin") {
            $breadlist[1] = array(__('delivery_route.title_list'), "delivery_route.list", null, "0");
            $breadlist[2] = array($data["delivery_route"]->getId(), "delivery_route.show",
                            ['id'=>$data['delivery_route']->getId()], "0");
            $breadlist[3] = array(__('delivery_route.title_update'), "", null, "1");
        } else {
            $breadlist[1] = array($data["delivery_route"]->getId(), "delivery_route.show",
                            ['id'=>$data['delivery_route']->getId()], "0");
            $breadlist[2] = array(__('delivery_route.title_update'), "", null, "1");
        }
        $data['breadlist'] = $breadlist;

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

        $splited_info = explode('-', $request->input('vehicle_id'));
        $data['vehicle_id'] = $splited_info[1];

        DeliveryRoute::create([
            'date' => $request->input('date'),
            'completed_deliveries' => $request->input('completed_deliveries'),
            'number_of_deliveries' => $request->input('number_of_deliveries'),
            'warehouse_id' => $data['warehouse_id'],
            'courier_id' => $data['courier_id'],
            'vehicle_id' => $data['vehicle_id'],
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

    public function importExport()
    {
        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('delivery_route.title_import_export'), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('delivery_route.import_export')->with("data", $data);
    }

    public function importFile(Request $request)
    {
        try {
            Excel::import(new DeliveryRoutesImport, $request->file('file')->store('temp'));
        } catch (Exception $e) {
            return redirect()->route('delivery_route.import_export')
                ->withErrors(__('delivery_route.error.wrong_format'));
        }
        
        return redirect()->route('delivery_route.list');
    }

    public function exportFile()
    {
        return Excel::download(new DeliveryRoutesExport, 'delivery-routes-list.xlsx');
    }

    public function downloadFormat()
    {
        $filename = "/csv/delivery_route_sample.csv";
        $file=public_path().$filename;
        
        $headers = [
            'Content-Type' => 'application/csv',
        ];

        return response()->download($file, 'delivery_route_sample.csv', $headers);
    }
}
