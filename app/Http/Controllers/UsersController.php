<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Etudient;
use App\Prof;
use App\Groupe;
use App\Media;

class UsersController extends Controller
{
    /*
     * Create a new controller instance.
     */

    public $model = 'user';
    public function filter_fields(){
        return [
            'avatar'=>null,
            'name'=>[
                'type'=>'text',
            ],
            'role'=>[
                'type'=>'select',
                'data'=>[
                    'EMPLOYE'=>'EMPLOYE',
                    'ADMIN'=>'ADMIN',
                ]
                /*'table' => 'users',
                'distinct' => 'role',
                'fields' => ['role as key_','role as value_'],*/
            ],
            'email'=>[
                'type'=>'text',
            ],
            'phone'=>[
                'type'=>'text',
            ],
            'groupes' => [
                'type' => 'select',
                'operation'=>null,
                'data' => [],
                'table' => 'groupes',
                'fields' => ['id as key_','name as value_'],
                'where' => [],
            ],
        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }

    /*
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where($this->filter(false))
                    ->whereNotIn('role',['Etudient','PROF'])
                    ->groupe()
                    ->orderBy($this->orderby, 'desc')
                    ->paginate($this->perpage())
                    ->withPath($this->url_params(true,['page'=>null]));

        return view('user.list', [
            'results'=>$users
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groupes = Groupe::all();
        
        return view('user.update',[
            'object'=> new User(),
            'groupes'=>$groupes
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $avatar = null;

        $media = new Media();
        if($request->file('avatar')){
            $media->_file = $request->file('avatar');
            $media->_path = 'Avatar';
            $media = $media->_save();

            if($media)
                $avatar = $media->id;
        }

        $user = User::create([
            'name'=>request('name'),
            'email'=>request('email'),
            'role'=>request('role'),
            'phone'=>request('phone'),
            'cin'=>request('cin'),
            'avatar'=>$avatar,
            'password'=>bcrypt( request('password') ),
        ]);

        if( $user && $user->id ) {
            if( $user->role == 'ETUDIENT') {
                $e = Etudient::create([
                    'user_id' => $user->id,
                    'cne' => request('cne'),
                ]);
            }elseif( $user->role == 'PROF') {
                $p = Prof::create([
                    'user_id' => $user->id,
                    'matricule' => request('cne'),
                ]);
            }
        }
        
        $user->groupes()->sync(request('groupe'));

        return redirect()->route('user_edit', $user->id);
    }

    /*
     * Display the specified resource.
     */

    public function show($id)
    {
        return $this->edit($id);
        /*$user = User::findOrFail($id);
        return view('user.show', [
            'object'=>$user
        ]);*/
    }

    /*
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $groupes = Groupe::all();

        return view('user.update', [
            'object'=>$user,
            'groupes'=>$groupes
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = request('name');
        $user->email = request('email');
        $user->cin = request('cin');
        $user->phone = request('phone');

        if( $user->role == 'ETUDIENT') {
            $e = $user->etudient;
            $e->cne = request('cne');
            $e->save();
        }elseif( $user->role == 'PROF') {
            $p = $user->prof;
            $p->matricule = request('cne');
            $p->save();
        }

        $media = new Media();
        if($request->file('avatar')){
            if($user->avatar)
                $media = Media::find($user->avatar);

            $media->_file = $request->file('avatar');
            $media->_path = 'Avatar';
            $media = $media->_save();

            if($media)
                $user->avatar = $media->id;
        }

        if(request('password'))
            $user->password = bcrypt(request('password'));
            
        $user->groupes()->sync(request('groupe'));
        
        $user->save();

        return redirect()->route('user_edit', $user->id);
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if( $user->picture )
            $user->picture->delete();
        $user->delete();

        return redirect()->route('user');
    }

}
