<?php

namespace App\Http\Controllers;

use App\Etudient;
use App\Media;
use App\User;
use App\Filier;
use App\Module;
use App\Cours;
use Illuminate\Http\Request;


class EtudientController extends Controller
{

    public $model = 'etudient';
    public function filter_fields(){
        return [
            'avatar'=>null,
            'cne'=>[
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
        $etudients = Etudient::where($this->filter(false))
                    ->userdata()
                    ->orderBy($this->orderby, 'desc')
                    ->paginate($this->perpage())
                    ->withPath($this->url_params(true,['page'=>null]));

        return view('etudient.list', [
            'results'=>$etudients
        ]);
    }



    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $filiers = Filier::all();
        $modules = Module::all();
        return view('etudient.update',[
            'object'=> new Etudient(),
            'filiers'=>$filiers,
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
            'role'=>"ETUDIENT",
            'phone'=>request('phone'),
            'cin'=>request('cin'),
            'avatar'=>$avatar,
            'password'=>bcrypt( request('password') ),
        ]);

        if( $user && $user->id ) {
            $etudient = Etudient::create([
                'user_id' => $user->id,
                'cne' => request('cne'),
            ]);

            if( $etudient && $etudient->id ){
                // all is good
                $etudient->filiers()->sync(request('new_filier'));
                $etudient->modules()->sync(request('new_module'));
            }else{
                // is etudient not create we need to destroy user
                if( $user->picture )
                    $user->picture->delete();
                $user->delete();
            }
        }

        return redirect()->route('etudient_edit', $user->id);
    }

    /*
     * Display the specified resource.
     */

    public function show($id)
    {
        return $this->edit($id);
        /*$user = User::findOrFail($id);
        return view('etudient.show', [
            'object'=>$user
        ]);*/
    }

    /*
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $etudient = Etudient::findOrFail($id);
        $filiers = Filier::all();
        $modules = Module::all();

        return view('etudient.update', [
            'object'=>$etudient,
            'filiers'=>$filiers,
            'modules'=>$modules,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        $etudient = Etudient::findOrFail($id);
        $user = $etudient->user;

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

        $etudient->cne = request('cne');

        $etudient->filiers()->sync(request('new_filier'));
        $etudient->modules()->sync(request('new_module'));

        $etudient->save();

        return redirect()->route('etudient_edit', $etudient->id);
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $etudient = Etudient::findOrFail($id);
        $user = $etudient->user;
        if( $user->picture )
            $user->picture->delete();
        $user->delete();

        return redirect()->route('etudient');
    }


    // frontend

    public function list_cours()
    {
        $auth = auth()->user();
        //dd($auth);
        $etudient = $auth->etudient;

        //$etudient->filier
        $courss = Cours::where($this->filter(false))
                        ->whereIn('module_id',$etudient->modules_ids())
                        ->orderBy('module_id', 'desc')
                        ->paginate($this->perpage())
                        ->withPath($this->url_params(true,['cours'=>null]));

        return view('etudient.list_cours', [
            'results'=>$courss
        ]);
    }

    public function show_cours($id)
    {
        $auth = auth()->user();
        $etudient = $auth->etudient;

        $cours = Cours::where('id',$id)
                        ->whereIn('module_id',$etudient->modules_ids())
                        ->firstOrfail();


        return view('etudient.show_cours', [
            'object'=>$cours
        ]);
    }

}
