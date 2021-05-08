<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->getRole()=="super_admin" ||
            Auth::user()->getRole()=="company_admin" ||
            Auth::user()->getRole()=="warehouse_admin") {
                return $next($request);
            } elseif (Auth::user()->getRole()=="courier" &&
                $request->route('id') == Auth::user()->getId()) {
                return $next($request);
            } elseif (Auth::user()->getRole()=="courier" &&
                $request->input('id') == Auth::user()->getId()) {
                return $next($request);
            }
            return redirect()->route('home.index');
        });
    }

    public function show($id)
    {
        $data = []; //to be sent to the view
        
        try {
            $user = User::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('home.index');
        }

        $data["title"] = $user->getName();
        $data["user"] = $user;

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        if (Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin") {
            $breadlist[1] = array(__('user.title_list'), "user.list", null, "0");
            $breadlist[2] = array($data["user"]->getName(), "", null, "1");
        } else {
            $breadlist[1] = array($data["user"]->getName(), "", null, "1");
        }
        $data['breadlist'] = $breadlist;

        return view('user.show')->with("data", $data);
    }
    
    public function list()
    {
        $data = []; //to be sent to the view
        $data["title"] = __('user.title');
        if (Auth::user()->getRole()=="super_admin") {
            $data["users"] = User::orderBy('id')->with('company')->with('warehouse')->paginate(5);
        } elseif (Auth::user()->getRole()=="company_admin") {
            $data["users"] = User::where('company_id', Auth::user()->getCompanyId())->orderBy('id')
                                ->with('company')->with('warehouse')->paginate(5);
        } elseif (Auth::user()->getRole()=="warehouse_admin") {
            $data["users"] = User::where('warehouse_id', Auth::user()->getWarehouseId())->orderBy('id')
                                ->with('company')->with('warehouse')->paginate(5);
        }
        
        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('user.title_list'), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('user.list')->with("data", $data);
    }
    
    public function update(Request $request)
    {
        $data = [];
        $data["title"] = __('user.title');

        try {
            $user = User::findOrFail($request->input('id'));
        } catch (Exception $e) {
            return redirect()->route('user.list');
        }

        $data["user"] = $user;

        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        if (Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin") {
            $breadlist[1] = array(__('user.title_list'), "user.list", null, "0");
            $breadlist[2] = array($data["user"]->getName(), "user.show", ['id'=>$data['user']->getId()], "0");
            $breadlist[3] = array(__('user.title_update'), "", null, "1");
        } else {
            $breadlist[1] = array($data["user"]->getName(), "user.show", ['id'=>$data['user']->getId()], "0");
            $breadlist[2] = array(__('user.title_update'), "", null, "1");
        }
        $data['breadlist'] = $breadlist;

        return view('user.update')->with("data", $data);
    }

    public function updateSave(Request $request)
    {

        User::where('id', $request->input('id'))->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'id_card_number' => $request->input('id_card_number'),
        ]);

        //return back()->with('success', __('company_update.succesful'));
        return redirect()->route('user.list');
    }

    public function delete(Request $request)
    {
        $user = User::find($request['id']);
        $user->setIsActive('0');
        $user->save();
        return redirect()->route('user.list');
    }

    public function importExport()
    {
        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "0");
        $breadlist[1] = array(__('user.title_import_export'), "", null, "1");
        $data['breadlist'] = $breadlist;

        return view('user.import_export')->with("data", $data);
    }

    public function importFile(Request $request)
    {
        try {
            Excel::import(new UsersImport, $request->file('file')->store('temp'));
        } catch (Exception $e) {
            return redirect()->route('user.import_export')->withErrors(__('user.error.wrong_format'));
        }
        
        return redirect()->route('user.list');
    }

    public function exportFile()
    {
        return Excel::download(new UsersExport, 'users-list.xlsx');
    }
}
