<?php

namespace App\Http\Controllers;

use App\Media;
use App\User;
use App\Cours;
use App\Prof;
use App\Filier;
use App\Module;
use App\Prof_module;
use Carbon\Carbon;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\ReponseController;
use Illuminate\Http\Request;


class ApiProfController extends Controller
{

    public function check(Request $request)
    {
        if( !$request->user()->prof || !$request->user()->prof->id )
            return response()->json([
                'error' => 'Professor Not found'
            ], 404);
    }

   //************************************* */
   //************  Login     ************ */
   //*********************************** */
    public function login(Request $request)
    {
        $this->validate($request,[
            'matricule'=>'required|string',
            'cin'=>'required|string',
        ]);

        $user = $request->user();

        if(!$user){
            $prof = Prof::where('matricule', request('matricule'))->whereHas('user',function($query){
                            $query->where([
                                ['cin',request('cin')],
                                ['role','PROF']
                            ]);
                        })->first();

            $user = $prof ? $prof->user : null;
        }

        if(!$user || ! \Auth::loginUsingId($user->id) )
            return response()->json(['message' => 'Unauthorized'], 401);

        $tokenResult = $user->createToken('Professor Login');

        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addWeeks(4);
        $token->save();

        $return = $prof->Json();
        $return['access_token'] = $tokenResult->accessToken;
        $return['token_type'] = 'Bearer';
        $return['expires_at'] = Carbon::parse($tokenResult->token->expires_at)->toDateTimeString();

        return response()->json($return);
    }

    public function details(Request $request)
    {
        $this->check($request);
        return response()->json([
            'prof' => $request->user()->prof->Json()
        ]);
    }
  
    /**************************************************
     * ******            verified           ***********
     * ************************************************
     */

     //*********** Get the professors the Courses  */
    public function Cours(Request $request){
        $this->check($request);
        $user = $request->user();
        $return = $user->prof->cours;
        return response()->json(
          $return
      );
    }

    //************** Get the professors Modules */
    public function Modules(Request $request){
       $this->check($request);
      $user = $request->user();
      $return = $user->prof->modules;
      return response()->json(
        $return
    );
  }
  
  //*************** Get all the existing branches */
  public function AllFilieres(Request $request){
    $this->check($request);
    $filiers = Filier::get();
    return response()->json(
        $filiers
    );
    }
  //**************** dic of {branch => [modules] } */
    public function Filier_Modules(Request $request){
            $this->check($request);
            $user = $request->user();
            $modules = $user->prof->modules;
            $return = [];
            foreach($modules as $module){
                $return[$module->filier->name][] = $module;
            }
            return response()->json(
            $return
        );
    }
        // the following function return the list of (question <-> response) of a particular course ( $course_id)
    public function Question_Rep(Request $request){
        $this->check($request);
        $user = $request->user();
        $cours = $user->prof->cours;
        foreach($cours as $cour){
            if($cour->id == 10 )
            $qsts = $cour->questions;
         }
      return response()->json([
        "questions" =>$qsts 
        ]);
    }
    /************************************
     * 
     *             Creat
     * 
     * ***********************************
     */
    public function Newcourse(Request $request)
    {
        $this->check($request);
        $user = $request->user();

        $C = new CoursController();
        $C->use_API = true;

        $return = $C->store($request);

    }
    public function NewQuestion(Request $request)
    {
        $this->check($request);
        $user = $request->user();
        $Q = new QuestionController();
        $Q->use_API = true;

        $return = $Q->store($request);
    }

    public function NewReponse(Request $request)
    {
        $this->check($request);
        $user = $request->user();
        $R = new ReponseController();
        $R->use_API = true;

        $return = $R->store($request);
    }
    

    /*****************************************
     *              Update 
     ******************************************/
     
    public function UpdateCour(Request $request)
    {
        $this->check($request);
        $user = $request->user();

        $C = new CoursController();
        $C->use_API = true;

        $return = $C->update($request, $request->id);
    }

    /***************************************
     *            Quiz  ( in process )
     **************************************/
    
    
    
     /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
