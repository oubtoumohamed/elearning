<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Module;
use App\Semester;
use App\Filier;

class ModuleController extends Controller
{
    public $model = 'module';
    public function filter_fields(){
        return [
            'ref'=>[
                'type'=>'text'
            ],
            'name'=>[
                'type'=>'text'
            ],
            'filier_id'=>[
                'type'=>'select',
                'table'=>'filiers',
                'fields' => ['id as key_','name as value_'],
            ],
            'semester_id'=>[
                'type'=>'select',
                'table'=>'semesters',
                'fields' => ['id as key_','name as value_'],
            ],
        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }
    public function index()
    {
        $modules = Module::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['module'=>null]));

        return view('module.list', [
            'results'=>$modules
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $semesters = Semester::all();
        $filiers = Filier::all();
        return view('module.update',[
            'object'=> new Module(),
            'semesters' => $semesters,
            'filiers' => $filiers,
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'ref' => 'required|string|max:255',
            'semester_id' => 'required|integer|max:255',
            'filier_id' => 'required|integer|max:255',
        ]);

        $module = Module::create([
            'ref'=>request('ref'),
            'name'=>request('name'),
            'description'=>request('description'),
            'filier_id'=>request('filier_id'),
            'semester_id'=>request('semester_id'),
        ]);
       

       return redirect()
                ->route('module_edit', $module->id)
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
        $module = Module::findOrFail($id);

        $semesters = Semester::all();
        $filiers = Filier::all();

        return view('module.update', [
            'object'=>$module,
            'semesters' => $semesters,
            'filiers' => $filiers,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'ref' => 'required|string|max:255',
            'semester_id' => 'required|integer|max:255',
            'filier_id' => 'required|integer|max:255',
        ]);
      
        $module = Module::findOrFail($id);

        $module->ref = request('ref');
        $module->name = request('name');
        $module->description = request('description');
        $module->filier_id = request('filier_id');
        $module->semester_id = request('semester_id');

        $module->save();

        return redirect()
                ->route('module_edit', $module->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $module = Module::findOrFail($id);

        if( $module->delete() ){            
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('module')
            ->with($flash_type, __('global.'.$msg));
    }
}