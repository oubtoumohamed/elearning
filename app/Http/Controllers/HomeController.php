<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use App\Session;
use App\User;

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
        $user = auth()->user();

        $return = [
            "cin" => $request->cin,
            "filier" => $user->etudient->filier(),
            "additional_modules" => $user->etudient->modules
        ];

        return response()->json(
            $return
        );


        return view('frontend.home');
    }

    public function admin()
    {
        return view('home');
    }
}
