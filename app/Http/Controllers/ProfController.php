<?php

namespace App\Http\Controllers;

use App\Prof;
use App\Media;
use App\Module;
use App\User;
use Illuminate\Http\Request;

class ProfController extends Controller
{

    public $model = 'prof';
    public function filter_fields(){
        return [
            'avatar'=>null,
            'matricule'=>[
                'type'=>'text',
                'operation'=>'='
            ],
            'name'=>[
                'type'=>'text',
                'operation'=>null,
            ],
            'cin'=>[
                'type'=>'text',
                'operation'=>null,
            ],
            'email'=>[
                'type'=>'text',
                'operation'=>null,
            ],
            'phone'=>[
                'type'=>'text',
                'operation'=>null,
            ]
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
        $users = Prof::where($this->filter(false))
                    ->userdata()
                    ->orderBy($this->orderby, 'desc')
                    ->paginate($this->perpage())
                    ->withPath($this->url_params(true,['page'=>null]));

        return view('prof.list', [
            'results'=>$users
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modules = Module::all();
        return view('prof.update',[
            'object'=> new Prof(),
            'modules'=>$modules,
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
            'role'=>"PROF",
            'phone'=>request('phone'),
            'cin'=>request('cin'),
            'avatar'=>$avatar,
            'password'=>bcrypt( request('password') ),
        ]);

        if( $user && $user->id ) {
            $prof = Prof::create([
                'user_id' => $user->id,
                'matricule' => request('matricule'),
            ]);

            if( $prof && $prof->id ){
                // all is good
                $prof->modules()->sync(request('new_module'));
            }else{
                // is prof not create we need to destroy user
                if( $user->picture )
                    $user->picture->delete();
                $user->delete();
            }
        }

        return redirect()->route('prof_edit', $prof->id);
    }

    /*
     * Display the specified resource.
     */

    public function show($id)
    {
        return $this->edit($id);
        /*$user = User::findOrFail($id);
        return view('prof.show', [
            'object'=>$user
        ]);*/
    }

    /*
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $prof = Prof::findOrFail($id);
        $modules = Module::all();

        return view('prof.update', [
            'object'=>$prof,
            'modules'=>$modules,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        $prof = Prof::findOrFail($id);
        $user = $prof->user;

        $user->name = request('name');
        $user->email = request('email');
        $user->cin = request('cin');
        $user->phone = request('phone');

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
        
        $user->save();

        $prof->matricule = request('matricule');

        $prof->modules()->sync(request('new_module'));

        $prof->save();

        return redirect()->route('prof_edit', $prof->id);
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $prof = Prof::findOrFail($id);
        $user = $prof->user;
        if( $user->picture )
            $user->picture->delete();
        $user->delete();

        return redirect()->route('prof');
    }

}
