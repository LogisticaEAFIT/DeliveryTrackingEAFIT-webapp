<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Http\Controllers;

use App\Exports\CompaniesExport;
use App\Http\Controllers\Controller;
use App\Imports\CompaniesImport;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->getRole()=="super_admin") {
                return $next($request);
            } elseif (Auth::user()->getRole()=="company_admin" &&
                $request->route('id') == Auth::user()->getCompanyId()) {
                return $next($request);
            } elseif (Auth::user()->getRole()=="company_admin" &&
                $request->input('id') == Auth::user()->getCompanyId()) {
                return $next($request);
            }
            return redirect()->route('home.index');
        });
    }

    public function show($id)
    {
        $data = []; //to be sent to the view
        
        try {
            $company = Company::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('home.index');
        }

        $data["title"] = $company->getName();
        $data["company"] = $company;

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        if (Auth::user()->getRole()=="super_admin") {
            $breadlist[1] = array(__('company.title_list'), "company.list", null, "0");
            $breadlist[2] = array($data["company"]->getName(), "", null, "1");
        } else {
            $breadlist[1] = array($data["company"]->getName(), "", null, "1");
        }
        $data['breadlist'] = $breadlist;


        return view('company.show')->with("data", $data);
    }
    
    public function list()
    {
        $data = []; //to be sent to the view
        $data["title"] = __('company_list.title');
        $data["companies"] = Company::orderBy('id')->paginate(5);

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('company.title_list'), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('company.list')->with("data", $data);
    }

    public function create()
    {
        $data = []; //to be sent to the view
        $data["title"] = __('company_create.title');

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('company.title_create'), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('company.create')->with("data", $data);
    }
    
    public function update(Request $request)
    {
        $data = [];
        $data["title"] = __('company_update.title');

        try {
            $company = Company::findOrFail($request->input('id'));
        } catch (Exception $e) {
            return redirect()->route('company.list');
        }

        $data["company"] = $company;

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        if (Auth::user()->getRole()=="super_admin") {
            $breadlist[1] = array(__('company.title_list'), "company.list", null, "0");
            $breadlist[2] = array($data["company"]->getName(), "company.show", ['id'=>$data['company']->getId()], "0");
            $breadlist[3] = array(__('company.title_update'), "", null, "1");
        } else {
            $breadlist[1] = array($data["company"]->getName(), "company.show", ['id'=>$data['company']->getId()], "0");
            $breadlist[2] = array(__('company.title_update'), "", null, "1");
        }
        $data['breadlist'] = $breadlist;

        return view('company.update')->with("data", $data);
    }

    public function updateSave(Request $request)
    {
        Company::validate($request);

        Company::where('id', $request->input('id'))->update([
            'name' => $request->input('name'),
            'contact_info' => $request->input('contact_info'),
        ]);

        return redirect()->route('company.list');
    }
    
    public function save(Request $request)
    {
        Company::validate($request);

        Company::create([
            'name' => $request->input('name'),
            'contact_info' => $request->input('contact_info')
        ]);

        return redirect()->route('company.list');
    }

    public function delete(Request $request)
    {
        $company = Company::find($request['id']);
        $company->setIsActive('0');
        $company->save();
        return redirect()->route('company.list');
    }

    public function reactivate(Request $request)
    {
        $company = Company::find($request['id']);
        $company->setIsActive('1');
        $company->save();
        return redirect()->route('company.list');
    }

    public function importExport()
    {
        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('company.title_import_export'), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('company.import_export')->with("data", $data);
    }

    public function importFile(Request $request)
    {
        try {
            Excel::import(new CompaniesImport, $request->file('file')->store('temp'));
        } catch (Exception $e) {
            return redirect()->route('company.import_export')->withErrors(__('company.error.wrong_format'));
        }
        
        return redirect()->route('company.list');
    }

    public function exportFile()
    {
        return Excel::download(new CompaniesExport, 'companies-list.xlsx');
    }

    public function downloadFormat()
    {
        $filename = "/csv/company_sample.csv";
        $file=public_path().$filename;
        
        $headers = [
            'Content-Type' => 'application/csv',
        ];

        return response()->download($file, 'company_sample.csv', $headers);
    }
}
