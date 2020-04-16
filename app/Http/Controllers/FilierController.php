<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Filier;

class FilierController extends Controller
{
    public $model = 'filier';
    public function filter_fields(){
        return [
            'name'=>[
                'type'=>'text'
            ],
            'description'=>[
                'type'=>'text'
            ]
        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }
    public function index()
    {
        $filiers = Filier::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['filier'=>null]));

        return view('filier.list', [
            'results'=>$filiers
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('filier.update',[
            'object'=> new Filier(),
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|string|max:255',
        ]);

        $filier = Filier::create([
            'name'=>request('name'),
            'description'=>request('description'),
        ]);
       

       return redirect()
                ->route('filier_edit', $filier->id)
                ->with('success', __('global.create_succees'));
    }

    /*
     * Display the specified resource.
     */

    public function show($id)
    {
        return $this->edit($id);
    }

    
    public function edit($id)
    {
        $filier = Filier::findOrFail($id);

        return view('filier.update', [
            'object'=>$filier
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'name' => 'required|string|max:255'
        ]);
      
        $filier = Filier::findOrFail($id);
        $filier->name = request('name');
        $filier->description = request('description');
        $filier->save();

        return redirect()
                ->route('filier_edit', $filier->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $filier = Filier::findOrFail($id);

        if( $filier->delete() ){            
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('filier')
            ->with($flash_type, __('global.'.$msg));
    }
}