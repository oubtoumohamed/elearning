<?php

namespace App\Http\Controllers;

use App\Media;
use App\User;
use App\Etudient;
use App\Prof;
use Illuminate\Http\Request;


class ApiController extends Controller
{

    /*==============================================================
    ||                  Etudient API functions                     ||
    ===============================================================*/

    public function EtudientLogin()
    {
        if( !request('cne') || !request('cin') )
            return response()->json(['error' => 'fileds required'], 404);

        $etudient = Etudient::where('cne', request('cne'))
                            ->whereHas('user', function ($query) {
                                $query->where('cin',request('cin')); 
                            })->first();

        if( $etudient and $etudient->id)
            return $etudient->Json();


        return response()->json(['error' => 'Unauthorized'], 401);
    }



    /*==============================================================
    ||                  Prof API functions                        ||
    ===============================================================*/

    public function ProfLogin()
    {
        if( !request('email') || !request('password') )
            return response()->json(['error' => 'fileds required'], 404);

        if( \Auth::attempt(['email'=>request('email'),'password'=>request('password'),'role'=>'PROF' ]) ){
            $prof = auth()->user()->prof;
            if( $prof and $prof->id )
                return $prof->Json();
            
            return response()->json(['error' => 'No prof'], 401);
        }


        return response()->json(['error' => 'Unauthorized'], 401);
    }

}
