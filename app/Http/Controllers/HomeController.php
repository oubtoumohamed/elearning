<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use App\Session;
use App\User;
use App\Filier;
use App\Prof_module;
use App\Http\Controllers\EtudientController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */



    public function index(Request $request)
    {
        
        return $this->view_('frontend.home');
    }


    public function admin()
    {
        return $this->view_('home');
    }
}
