<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Portpolio;
use DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['portpolio'] = Portpolio::all();
        return view('front.home', $data);
    }

    public function portpolio() 
    {
        $data['portpolio'] = Portpolio::all();
        return view('front.portpolio', $data);
    }

    public function portpolio_detail($id) 
    {
        $data['portpolio'] = Portpolio::where('id', $id)->first();
        return view('front.portpolio_detail', $data);
    }

}