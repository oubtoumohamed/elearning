<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Semester;

class SemesterController extends Controller
{
    public $model = 'semester';
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
        $semesters = Semester::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['semester'=>null]));

        return $this->view_('semester.list', [
            'results'=>$semesters
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->view_('semester.update',[
            'object'=> new Semester(),
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

        $semester = Semester::create([
            'name'=>request('name'),
        ]);
       

       return redirect()
                ->route('semester_edit', $semester->id)
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
        $semester = Semester::findOrFail($id);

        return $this->view_('semester.update', [
            'object'=>$semester
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
      
        $semester = Semester::findOrFail($id);
        $semester->name = request('name');
        $semester->save();

        return redirect()
                ->route('semester_edit', $semester->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $semester = Semester::findOrFail($id);
                    
        if( $semester->delete() ){            
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('semester')
            ->with($flash_type, __('global.'.$msg));
    }
}