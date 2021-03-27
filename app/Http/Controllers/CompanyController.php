<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
Use Exception;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->getRole()=="super_admin"){
                return $next($request);
            }
            return redirect()->route('home.index');
        });
    }

    public function show($id)
    {
        $data = []; //to be sent to the view
        
        try{
            $company = Company::findOrFail($id);
        }catch(Exception $e){
            return redirect()->route('home.index');
        }

        $data["title"] = $company->getName();
        $data["company"] = $company;
        return view('company.show')->with("data",$data);
    }
    
    public function list()
    {
        $data = []; //to be sent to the view
        $data["title"] = __('company_list.title');
        $data["companies"] = Company::orderBy('id')->get();

        return view('company.list')->with("data",$data);

    }

    public function create()
    {
        $data = []; //to be sent to the view
        $data["title"] = __('company_create.title');

        return view('company.create')->with("data",$data);

    }
    
    public function update(Request $request)
    {
        $data = [];
        $data["title"] = __('company_update.title');

        try{
            $company = Company::findOrFail($request->input('id'));
        }catch(Exception $e){
            return redirect()->route('company.list');
        }

        $data["company"] = $company;

        return view('company.update')->with("data", $data);
    }

    public function updateSave(Request $request){
        $company = Company::findOrFail($request->input('id'));

        if($company->getName() != $request->input('name')){
            $company->setName($request->input('name'));
        }
        if($company->getContactInfo() != $request->input('contact_info')){
            $company->setContactInfo($request->input('contact_info'));
        }

        $company->save();

        //return back()->with('success', __('company_update.succesful'));
        return redirect()->route('company.list');
    }
    
    public function save(Request $request)
    {
        Company::validate($request);

        $company = new Company();
        $company->setName($request->input('name'));
        $company->setContactInfo($request->input('contact_info'));
        $company->save();

        return back()->with('success', __('company_create.succesful'));
    }

    public function delete(Request $request){
        $company = Company::find($request['id']);
        $company->delete();
        return redirect()->route('company.list');
    }

}