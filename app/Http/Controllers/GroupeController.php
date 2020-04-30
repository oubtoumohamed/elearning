<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Groupe;
use App\Cat;
use App\Media;

class GroupeController extends Controller
{
    public $model = 'groupe';
    public function filter_fields(){
        return [
            'name'=>[
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
        $groupes = Groupe::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['page'=>null]));

        return $this->view_('groupe.list', [
            'results'=>$groupes
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->view_('groupe.update',[
            'object'=> new Groupe(),
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|string|max:255|unique:groupes'
        ]);

        $groupe = Groupe::create([
            'name'=>request('name'),
            'roles'=> implode(',',request('roles')),
        ]);

       return redirect()
                ->route('groupe_edit', $groupe->id)
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
        $groupe = Groupe::findOrFail($id);

        return $this->view_('groupe.update', [
            'object'=>$groupe,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'name' => 'required|string|max:255|unique:groupes,name,'.$id
        ]);
      
        $groupe = Groupe::findOrFail($id);
        $groupe->name = request('name');
        $groupe->roles =  implode(',',request('roles'));
        
        $groupe->save();

        return redirect()
                ->route('groupe_edit', $groupe->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $groupe = Groupe::findOrFail($id);

        if( $groupe->delete() ){
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('groupe')
            ->with($flash_type, __('global.'.$msg));
    }
}