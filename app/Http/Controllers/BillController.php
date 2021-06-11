<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Http\Controllers;

use App\Exports\BillsExport;
use App\Http\Controllers\Controller;
use App\Imports\BillsImport;
use App\Imports\ServicesImport;
use App\Models\Bill;
use App\Models\DeliveryRoute;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class BillController extends Controller
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
            $bill = Bill::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('home.index');
        }

        $data["bill"] = $bill;

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('service.navbar_title'),
                        "service.show", ['id'=>$bill->getServiceId()], "0");
        $breadlist[2] = array($data["bill"]->getId(), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('bill.show')->with("data", $data);
    }
    
    public function update(Request $request)
    {
        $data = [];
        $data["title"] = __('bill.title');

        try {
            $bill = Bill::findOrFail($request->input('id'));
        } catch (Exception $e) {
            return redirect()->route('delivery_route.list');
        }

        $data["bill"] = $bill;


        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('service.navbar_title') + " " + $bill->getServiceId(),
                        "service.show", ['id'=>$bill->getServiceId()], "0");
        $breadlist[2] = array($data["bill"]->getId(), "bill.show",
                        ['id'=>$data['bill']->getId()], "0");
        $breadlist[3] = array(__('bill.title_update'), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('bill.update')->with("data", $data);
    }

    public function updateSave(Request $request)
    {
        Bill::validate($request);

        Bill::where('id', $request->input('id'))->update([
            'observations' => $request->input('observations'),
            'amount_to_be_paid' => $request->input('amount_to_be_paid'),
            'paid_in_advance' => $request->input('paid_in_advance'),
            'amount_paid' => $request->input('amount_paid'),
            'payment_type' => $request->input('payment_type'),
        ]);

        return redirect()->route('bill.show', ['id'=>$request->input('id')]);
    }

    public function importExport()
    {
        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('bill.title_import_export'), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('bill.import_export')->with("data", $data);
    }

    public function importFile(Request $request)
    {
        try {
            Excel::import(new BillsImport, $request->file('file')->store('temp'));
        } catch (Exception $e) {
            return redirect()->route('bill.import_export')->withErrors(__('bill.error.wrong_format'));
        }
        
        return redirect()->route('bill.import_export');
    }

    public function exportFile()
    {
        return Excel::download(new BillsExport, 'bills-list.xlsx');
    }

    public function downloadFormat()
    {
        $filename = "/csv/bill_sample.csv";
        $file=public_path().$filename;
        
        $headers = [
            'Content-Type' => 'application/csv',
        ];

        return response()->download($file, 'bill_sample.csv', $headers);
    }
}
