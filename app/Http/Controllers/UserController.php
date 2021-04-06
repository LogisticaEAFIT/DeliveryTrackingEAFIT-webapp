<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Exception;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin"){
                return $next($request);
            }
            return redirect()->route('home.index');
        });
    }

    public function show($id)
    {
        $data = []; //to be sent to the view
        
        try{
            $user = User::findOrFail($id);
        }catch(Exception $e){
            return redirect()->route('home.index');
        }

        $data["title"] = $user->getName();
        $data["user"] = $user;
        return view('user.show')->with("data",$data);
    }
    
    public function list()
    {
        $data = []; //to be sent to the view
        $data["title"] = __('user.title');
        if(Auth::user()->getRole()=="super_admin"){
            $data["users"] = User::orderBy('id')->get();
        }else{
            $data["users"] = User::where('company_id', Auth::user()->getCompanyId())->orderBy('id')->get();
        }
        

        return view('user.list')->with("data",$data);

    }
    
    public function update(Request $request)
    {
        $data = [];
        $data["title"] = __('user.title');

        try{
            $user = User::findOrFail($request->input('id'));
        }catch(Exception $e){
            return redirect()->route('user.list');
        }

        $data["user"] = $user;

        return view('user.update')->with("data", $data);
    }

    public function updateSave(Request $request){

        User::where('id', $request->input('id'))->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'id_card_number' => $request->input('id_card_number'),
        ]);

        //return back()->with('success', __('company_update.succesful'));
        return redirect()->route('user.list');
    }

    public function delete(Request $request){
        $user = User::find($request['id']);
        $user->setIsActive('0');
        $user->save();
        return redirect()->route('user.list');
    }

}