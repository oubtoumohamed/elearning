<?php

namespace App\Http\Controllers;

use App\Media;
use App\User;
use App\Etudient;
use App\Prof;
use App\Cours;
use App\Cours_question;
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

    public function modules_semesters(Request $request)
    {
        $this->check($request);

        $user = $request->user();
        $return = array();

        // modules of filier

        foreach ($user->etudient->filier()->modules as $module) {

        	$semester = $module->semester;
        	
        	if( !array_key_exists($semester->id, $return))
        		$return[ $semester->id ] = [
        			'id' => $semester->id,
        			'name' => $semester->name,
        			'modules' => [],
        		];
        	$return[ $semester->id ]['modules'][] = $module;
        }

        // aded modules
		$return[ -1 ] = [
			'id' => -1,
			'name' => "added modules",
			'modules' => [],
		];

        foreach ($user->etudient->modules as $module) {

        	$semester = $module->semester;
        	
        	if( !array_key_exists("added - ".$semester->id, $return))
        		$return[ "added - ".$semester->id ] = [
        			'id' => $semester->id,
        			'name' => $semester->name,
        			'modules' => [],
        		];
        	$return[ "added - ".$semester->id ]['modules'][] = $module;
        }

        return response()->json(
        	array_values( $return )
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

        $return = $this->Etud_Ctrl->list_cours()['results'];
        //$return = $e->show_cours(4);
        $filter = request('filter');
        if( array_key_exists("now", $filter) ){
        	$return = $return->items() ? $return->items()[0] : null;
        }else{
        	$return = $return->items();
        }

        return response()->json(
            $return
        );
    }

    public function course(Request $request)
    {
        $this->check($request);

        $user = $request->user();

        $return = $this->Etud_Ctrl->show_cours($request->id)['object'];

        return response()->json(
            $return
        );
    }
    // course messages
    public function messages(Request $request)
    {
        $this->check($request);

        $user = $request->user();

        $wheres = [
        	['cours_id', '=', $request->cours_id]
        ];
        if( $request->id )
	        $wheres[] = ['id', '>=', $request->id];


        $return = Cours_question::where($wheres)->limit(10)->get();

        //$return = $this->Etud_Ctrl->show_cours($request->id)['object'];

        return response()->json(
            $return
        );
    }

    public function send_message(Request $request)
    {
        $this->check($request);

        $user = $request->user();

        $question = Cours_question::create([
            'contenu'=>$request->msg,
            'cours_id'=>$request->cours_id,
            'user_id'=>$user->id,
            'question_id'=>$request->question_id
        ]);

        $return = ( $question && $question->id );

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
