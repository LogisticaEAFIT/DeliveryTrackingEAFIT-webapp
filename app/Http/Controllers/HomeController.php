<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [];
        $breadlist = array();
        $breadlist[0] = array(__('pagination.home'), "home.index", null, "1");
        $data['breadlist'] = $breadlist;

        return view('home.index')->with("data", $data);
    }

    public function home()
    {
        return redirect()->route('home.index');
    }
}
