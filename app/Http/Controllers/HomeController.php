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
        /*$user = auth()->user();

        $e = new EtudientController();
        $e->use_API = true;

        $object = $e->show_cours($request->id)['object'];

        foreach ($object->questions as $q) {
            $q->reponses;
            $msg[] = $q->toArray();
        }
        
        $return = $object;



        /*$return = [
            "filier" => $user->etudient->filier()->modules,
            "additional_modules" => $user->etudient->modules
        ];*/

        /*return response()->json(
            $return
        );*/


        return $this->view_('frontend.home');
    }


    public function admin()
    {
        return $this->view_('home');
    }
}
