<?php

namespace App\Http\Controllers;

use App\Media;
use App\User;
use App\Etudient;
use App\Prof;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ApiEtudientController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ]);        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);        $user->save();        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

  
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
        $this->validate($request,[
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);        $credentials = request(['email', 'password']);        if(!\Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);        $user = $request->user();        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);        $token->save();        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
    public function login2(Request $request)
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

        if(! \Auth::loginUsingId($user->id) )
            return response()->json(['message' => 'Unauthorized'], 401);

        $tokenResult = $user->createToken('Elearning');
        /*$token = $tokenResult->token;

        $token->expires_at = Carbon::now()->addWeeks(4);

        $token->save();
*/
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            /*'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'etudient' => $etudient->json(),*/
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
    public function details(Request $request)
    {
        return response()->json($request->user());
    }
}
