<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use App\Exports\RouteSegmentsExport;
use App\Exports\VehiclesExport;
use App\Http\Controllers\Controller;
use App\Imports\CustomersImport;
use App\Imports\RouteSegmentsImport;
use App\Imports\VehiclesImport;
use App\Models\Company;
use App\Models\Customer;
use App\Models\DeliveryRoute;
use App\Models\RouteSegment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Warehouse;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class RouteSegmentController extends Controller
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
            $route_segment = RouteSegment::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('home.index');
        }

        $data["route_segment"] = $route_segment;

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('delivery_route.navbar_title'),
                        "delivery_route.show", ['id'=>$route_segment->getDeliveryRouteId()], "0");
        $breadlist[2] = array($data["route_segment"]->getId(), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('route_segment.show')->with("data", $data);
    }

    public function create()
    {
        $data = []; //to be sent to the view
        $data["title"] = __('route_segment.title');
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
        $breadlist[1] = array(__('route_segment.title_create'), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('route_segment.create')->with("data", $data);
    }
    
    public function update(Request $request)
    {
        $data = [];
        $data["title"] = __('route_segment.title');

        try {
            $route_segment = RouteSegment::findOrFail($request->input('id'));
        } catch (Exception $e) {
            return redirect()->route('delivery_route.list');
        }

        $data["route_segment"] = $route_segment;


        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('delivery_route.navbar_title') + " " + $route_segment->getDeliveryRouteId(),
                        "delivery_route.show", ['id'=>$route_segment->getDeliveryRouteId()], "0");
        $breadlist[2] = array($data["route_segment"]->getId(), "route_segment.show",
                        ['id'=>$data['route_segment']->getId()], "0");
        $breadlist[3] = array(__('route_segment.title_update'), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('route_segment.update')->with("data", $data);
    }

    public function updateSave(Request $request)
    {
        RouteSegment::validate($request);

        RouteSegment::where('id', $request->input('id'))->update([
            'lower_time_window' => $request->input('lower_time_window'),
            'upper_time_window' => $request->input('upper_time_window'),
            'route_order' => $request->input('route_order'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        return redirect()->route('route_segment.show', ['id'=>$request->input('id')]);
    }
    
    public function save(Request $request)
    {
        RouteSegment::validate($request);

        $route_segment = RouteSegment::create([
            'lower_time_window' => $request->input('lower_time_window'),
            'upper_time_window' => $request->input('upper_time_window'),
            'route_order' => $request->input('route_order'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'delivery_route_id' => $request->input('delivery_route_id'),
        ]);

        return redirect()->route('route_segment.show', ['id'=>$route_segment->getId()])
                ->with('success', __('route_segment.succesful'));
    }

    public function delete(Request $request)
    {
        $route_segment = RouteSegment::find($request['id']);
        $route_segment->setStatus('completed');
        $route_segment->save();
        return redirect()->route('route_segment.show', ['id'=>$route_segment->getId()]);
    }

    public function reactivate(Request $request)
    {
        $route_segment = RouteSegment::find($request['id']);
        $route_segment->setStatus('uncompleted');
        $route_segment->save();
        return redirect()->route('route_segment.show', ['id'=>$route_segment->getId()]);
    }

    public function importExport()
    {
        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('route_segment.title_import_export'), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('route_segment.import_export')->with("data", $data);
    }

    public function importFile(Request $request)
    {
        try {
            Excel::import(new RouteSegmentsImport, $request->file('file')->store('temp'));
        } catch (Exception $e) {
            return redirect()->route('route_segment.import_export')->withErrors(__('route_segment.error.wrong_format'));
        }
        
        return redirect()->route('route_segment.import_export');
    }

    public function exportFile()
    {
        return Excel::download(new RouteSegmentsExport, 'route-segments-list.xlsx');
    }

    public function downloadFormat()
    {
        $filename = "/csv/route_segment_sample.csv";
        $file=public_path().$filename;
        
        $headers = [
            'Content-Type' => 'application/csv',
        ];

        return response()->download($file, 'route_segment_sample.csv', $headers);
    }
}
