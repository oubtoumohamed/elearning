<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use App\Session;
use App\User;
use App\Filier;
use App\Prof_module;

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
     
    *public function index()
    *{
    *   return view('frontend.home');
    *}
    */

    public function ProfModules(Request $request){
       
      $user = auth()->user();
        $module_prof = Prof_module::where('prof_id',$user->prof->id)->get();
        $module = Module::whereIn('modules.id', '=',$module_prof)->get();
        return response()->json(
            $module
        );
    }  
    public function index(Request $request)
    {
      /*  $user = auth()->user();
       $module_prof = Prof_module::where('prof_id',9)->pluck('module_id');
       $module = Module::whereIn('modules.id',$module_prof)->pluck('name');
        $filiere = Filiere::whereIn('id',)*/
     
      $module = $this->ProfModules($request);
       //where('id',$modle_prof)->get();
       //$prof_filiere = Filier::where('id',Module::pluck('id')->where())->get();
       //join(Module , 'Filiere.id', '=', 'Module.filier_id')->get();
        // $filier = Filier::get();
       /* $filier = Filier::where('filiere_id',re );
        $return = [
            "cin" => ,
            'matricule' => $user->prof->matricule,
            "modules" => $user->prof->module->,
            "Role"=> $user->role,

        ];
*/         
      return            $module   ;  


        //return view('frontend.home');
    }    
    public function admin()
    {
        return view('home');
    }
}
