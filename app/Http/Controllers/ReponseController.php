<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Reponse;
use App\User;
use App\Question;

class ReponseController extends Controller
{
    public $model = 'reponse';
    public function filter_fields(){
        return [
            'contenu'=>[
                'type'=>'text'
            ],
            'user_id'=>[
                'type'=>'select',
                'table'=>'users',
                'fields' => ['id as key_','name as value_'],
            ],
            'question_id'=>[
                'type'=>'select',
                'table'=>'questions',
                'fields' => ['id as key_','titre as value_'],
            ],
        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }
    public function index()
    {
        $reponses = Reponse::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['reponse'=>null]));

        return view('reponse.list', [
            'results'=>$reponses
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $questions = Question::all();
        return view('reponse.update',[
            'object'=> new Reponse(),
            'users' => $users,
            'questions' => $questions,
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'contenu' => 'required|string|max:255',
            'user_id' => 'required|integer|max:255',
            'question_id' => 'required|integer|max:255',
        ]);

        $reponse = Reponse::create([
            'contenu'=>request('contenu'),
            'user_id'=>request('user_id'),
            'question_id'=>request('question_id'),
        ]);
       

       return redirect()
                ->route('reponse_edit', $reponse->id)
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
        $reponse = Reponse::findOrFail($id);

        $users = User::all();
        $questions = Question::all();

        return view('reponse.update', [
            'object'=>$reponse,
            'users' => $users,
            'questions' => $questions,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $this->validate(request(), [
            'contenu' => 'required|string|max:255',
            'user_id' => 'required|integer|max:255',
            'question_id' => 'required|integer|max:255',
        ]);
      
        $reponse = Reponse::findOrFail($id);

        $reponse->contenu = request('contenu');
        $reponse->user_id = request('user_id');
        $reponse->question_id = request('question_id');

        $reponse->save();

        return redirect()
                ->route('reponse_edit', $reponse->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $reponse = Reponse::findOrFail($id);

        if( $reponse->delete() ){            
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('reponse')
            ->with($flash_type, __('global.'.$msg));
    }
}