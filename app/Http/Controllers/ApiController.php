<?php

namespace App\Http\Controllers;

use App\Media;
use App\User;
use App\Etudient;
use App\Prof;
use Illuminate\Http\Request;


class ApiController extends Controller
{
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        return response()->json([
            'token_type' => 'Bearer',
        ]);
        dd("lkjl");
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);

        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
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
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

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
