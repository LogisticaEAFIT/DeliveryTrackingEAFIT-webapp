<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use App\Exports\ServicesExport;
use App\Exports\VehiclesExport;
use App\Http\Controllers\Controller;
use App\Imports\CustomersImport;
use App\Imports\ServicesImport;
use App\Imports\VehiclesImport;
use App\Models\Company;
use App\Models\Customer;
use App\Models\DeliveryRoute;
use App\Models\Service;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Warehouse;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {

            if (Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin"
                || Auth::user()->getRole()=="warehouse_admin" || Auth::user()->getRole()=="courier") {
                return $next($request);
            }
            return redirect()->route('home.index');
        });
    }

    public function show($id)
    {
        $data = []; //to be sent to the view
        
        try {
            $service = Service::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('home.index');
        }

        $data["service"] = $service;

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('delivery_route.navbar_title'),
                        "delivery_route.show", ['id'=>$service->getDeliveryRouteId()], "0");
        $breadlist[2] = array($data["service"]->getId(), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('service.show')->with("data", $data);
    }

    public function create()
    {
        $data = []; //to be sent to the view
        $data["title"] = __('service.title');
        $data["delivery_routes"] = DeliveryRoute::orderBy('id')->get();

        if (Auth::user()->getRole()=="company_admin") {
            $ids = [];
            foreach (Auth::user()->company->warehouses as $warehouse) {
                array_push($ids, $warehouse->getId());
            }
            $data["delivery_routes"] = DeliveryRoute::whereIn('warehouse_id', $ids)
                                        ->orderBy('id')->get();
        }

        if (empty(array($data["delivery_routes"]))) {
            return redirect()->route('delivery_route.create')->withErrors(__('delivery_route.create_delivery_route'));
        }

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('service.title_create'), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('service.create')->with("data", $data);
    }
    
    public function update(Request $request)
    {
        $data = [];
        $data["title"] = __('service.title');

        try {
            $service = Service::findOrFail($request->input('id'));
        } catch (Exception $e) {
            return redirect()->route('delivery_route.list');
        }

        $data["service"] = $service;


        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('delivery_route.navbar_title') + " " + $service->getDeliveryRouteId(),
                        "delivery_route.show", ['id'=>$service->getDeliveryRouteId()], "0");
        $breadlist[2] = array($data["service"]->getId(), "service.show",
                        ['id'=>$data['service']->getId()], "0");
        $breadlist[3] = array(__('service.title_update'), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('service.update')->with("data", $data);
    }

    public function updateSave(Request $request)
    {
        Service::validate($request);

        Service::where('id', $request->input('id'))->update([
            'lower_time_window' => $request->input('lower_time_window'),
            'upper_time_window' => $request->input('upper_time_window'),
            'route_order' => $request->input('route_order'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        return redirect()->route('service.show', ['id'=>$request->input('id')]);
    }
    
    public function save(Request $request)
    {
        Service::validate($request);

        $service = Service::create([
            'lower_time_window' => $request->input('lower_time_window'),
            'upper_time_window' => $request->input('upper_time_window'),
            'route_order' => $request->input('route_order'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'delivery_route_id' => $request->input('delivery_route_id'),
        ]);

        return redirect()->route('service.show', ['id'=>$service->getId()])
                ->with('success', __('service.succesful'));
    }

    public function delete(Request $request)
    {
        $service = Service::find($request['id']);
        $service->setStatus('completed');
        $service->save();
        $this->updateDeliveryRouteValues($service->deliveryRoute->getId());
        return redirect()->route('service.show', ['id'=>$service->getId()]);
    }

    public function reactivate(Request $request)
    {
        $service = Service::find($request['id']);
        $service->setStatus('uncompleted');
        $service->save();
        $this->updateDeliveryRouteValues($service->deliveryRoute->getId());
        return redirect()->route('service.show', ['id'=>$service->getId()]);
    }

    public function updateDeliveryRouteValues($id)
    {
        try {
            $delivery_route = DeliveryRoute::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('delivery_route.list');
        }

        $services = $delivery_route->services;
        $counter = 0;
        $completed_counter = 0;

        foreach ($services as $service) {
            if ($service->getStatus() == 'completed') {
                $completed_counter += 1;
            }
            $counter += 1;
        }

        $delivery_route->setCompletedDeliveries($completed_counter);
        $delivery_route->setNumberOfDeliveries($counter);
        $delivery_route->save();
    }

    public function importExport()
    {
        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('service.title_import_export'), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('service.import_export')->with("data", $data);
    }

    public function importFile(Request $request)
    {
        try {
            Excel::import(new ServicesImport, $request->file('file')->store('temp'));
        } catch (Exception $e) {
            return redirect()->route('service.import_export')->withErrors(__('service.error.wrong_format'));
        }
        
        return redirect()->route('service.import_export');
    }

    public function exportFile()
    {
        return Excel::download(new ServicesExport, 'route-segments-list.xlsx');
    }

    public function downloadFormat()
    {
        $filename = "/csv/service_sample.csv";
        $file=public_path().$filename;
        
        $headers = [
            'Content-Type' => 'application/csv',
        ];

        return response()->download($file, 'service_sample.csv', $headers);
    }
}
