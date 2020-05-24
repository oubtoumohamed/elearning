<?php

namespace App\Http\Controllers;

use App\Media;
use App\User;
use App\Etudient;
use App\Prof;
use App\Cours;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\EtudientController;


class ApiEtudientController extends Controller
{
    public $Etud_Ctrl;

    public function check(Request $request)
    {
        if( !$request->user()->etudient || !$request->user()->etudient->id )
            return response()->json([
                'error' => 'Student Not found'
            ], 404);

        $this->Etud_Ctrl = new EtudientController();
        $this->Etud_Ctrl->use_API = true;
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'cne' => 'required|string',
            'cin' => 'required|string',
        ]);

        $user = $request->user();

        if(!$user){
            $etudient = Etudient::where('cne', request('cne'))->whereHas('user',function($query){
                            $query->where([
                                ['cin',request('cin')],
                                ['role','ETUDIENT']
                            ]);
                        })->first();

            $user = $etudient ? $etudient->user : null;
        }

        if(!$user || ! \Auth::loginUsingId($user->id) )
            return response()->json(['message' => 'Unauthorized'], 401);

        $tokenResult = $user->createToken('Student Login');

        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addWeeks(4);
        $token->save();

        $return = $user->etudient->Json();
        $return['access_token'] = $tokenResult->accessToken;
        $return['token_type'] = 'Bearer';
        $return['expires_at'] = Carbon::parse($tokenResult->token->expires_at)->toDateTimeString();

        return response()->json($return);
    }

    public function details(Request $request)
    {
        $this->check($request);
        return response()->json(
            $request->user()->etudient->Json()
        );
    }

    public function filiere(Request $request)
    {
        $this->check($request);

        $user = $request->user();
        $return = $user->etudient->filier();

        return response()->json(
            $return
        );
    }

    public function modules(Request $request)
    {
        $this->check($request);

        /*?filter[start][operation]=date-time-like&filter[start][value]=2020-04-17&filter[end][operation]=date-time-like&filter[end][value]*/

        $user = $request->user();
        $return = [
            "filier" => $user->etudient->filier()->modules,
            "additional_modules" => $user->etudient->modules
        ];

        return response()->json(
            $return
        );
    }

    public function courses(Request $request)
    {
        $this->check($request);

        $user = $request->user();

        $this->Etud_Ctrl->filier_array_fields = [
            'titre'	=>	[ 'type'=>'text' ],
            'type'	=>	[ 'type'=>'text' ],
            'module_id'	=>	[ 'type'=>'number' ],
            'start'	=>	[ 'type'=>'datetimepicker', 'operation'=>'<=' ],
            'end'	=>	[ 'type'=>'datetimepicker', 'operation'=>'>=' ]
        ];

        //?filter[start][value]=2020-05-24 19:18&filter[end][value]=2020-05-24 20


        $return = $this->Etud_Ctrl->list_cours()['results'];
        //$return = $e->show_cours(4);

        return response()->json(
            $return
        );
    }

    /*public function course_now()
    {
        $this->check($request);
        $user = $request->user();

        $return = $this->Etud_Ctrl->show_cours($request->id)['object'];

        return response()->json(
            $return
        );

        //$etudient->filier
        $now = Carbon::now()->format('y-m-d');
        $courss = Cours::where([
        					['start', '>=' ,$now],
        					['end', '<=' ,$now]
        				])
                        ->whereIn('module_id',$user->etudient->modules_ids())
                        ->orderBy('module_id', 'desc')
                        ->paginate($this->perpage())
                        ->withPath($this->url_params(true,['cours'=>null]));

        return $this->view_('etudient.list_cours', [
            'results'=>$courss
        ]);
    }*/

    public function course(Request $request)
    {
        $this->check($request);

        $user = $request->user();

        $return = $this->Etud_Ctrl->show_cours($request->id)['object'];

        return response()->json(
            $return
        );
    }


  
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
