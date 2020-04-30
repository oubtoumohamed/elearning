<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Question;
use App\User;
use App\Media;

class QuestionController extends Controller
{
    public $model = 'question';
    public function filter_fields(){
        return [
            'avatar'=>null,
            'titre'=>[
                'type'=>'text'
            ],
            'contenu'=>[
                'type'=>'text'
            ],
            'user_id'=>[
                'type'=>'select',
                'table'=>'users',
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
        $questions = Question::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['question'=>null]));

        return $this->view_('question.list', [
            'results'=>$questions
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return $this->view_('question.update',[
            'object'=> new Question(),
            'users' => $users,
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $avatar = null;

        $media = new Media();
        if($request->file('photo')){
            $media->_file = $request->file('photo');
            $media->_path = 'Question';
            $media = $media->_save();

            if($media)
                $avatar = $media->id;
        }

        $this->validate(request(), [
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string|max:255',
            'user_id' => 'required|integer|max:255',
        ]);

        $question = Question::create([
            'titre'=>request('titre'),
            'contenu'=>request('contenu'),
            'user_id'=>request('user_id'),
            'photo'=>$avatar,
        ]);
       

       return redirect()
                ->route('question_edit', $question->id)
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
        $question = Question::findOrFail($id);

        $users = User::all();

        return $this->view_('question.update', [
            'object'=>$question,
            'users' => $users,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $this->validate(request(), [
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string|max:255',
            'user_id' => 'required|integer|max:255', 
        ]);
      
        $question = Question::findOrFail($id);

        $question->titre = request('titre');
        $question->contenu = request('contenu');
        $question->user_id = request('user_id');

        $question->save();

        return redirect()
                ->route('question_edit', $question->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $question = Question::findOrFail($id);

        if( $question->delete() ){            
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('question')
            ->with($flash_type, __('global.'.$msg));
    }
}