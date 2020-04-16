<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Cours;
use App\Cours_question;
use App\Quizquestion;

class CoursController extends Controller
{
    public $model = 'cours';
    public function filter_fields(){
        $auth = auth()->user();
        $prof = $auth->prof;
        $etudient = $auth->etudient;

        $data = [
            'titre' => [
                'type' => 'text'
            ],
            'type'=>[
                'type'=>'select',
                'data'=>[
                    'Cours'=>'Cours',
                    'TP'=>'TP',
                    'TD'=>'TD',
                ]
            ],
            'module_id' => [],
            'start' => [
                'type' => 'datetimepicker'
            ],
            'end' => [
                'type' => 'datetimepicker'
            ]
        ];

        if( $prof and $prof->id ){
            $data['module_id'] =  [
                'type' => 'select',
                'operation'=>'=',
                'table' => 'modules',
                'join'=>[
                    'prof_modules',
                    'modules.id',
                    'prof_modules.module_id'
                ],
                'fields' => ['modules.id as key_','modules.name as value_'],
                'where' => [
                    ['prof_id',$prof->id]
                ]
            ];
        }elseif( $etudient and $etudient->id ){
            $data['module_id'] =  [
                'type' => 'select',
                'operation'=>'=',
                'table' => 'modules',
                'fields' => ['id as key_','name as value_'],
                'whereIn' => ['id',$ids ]
            ];

        }

        return $data;
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }
    public function index()
    {
        $auth = auth()->user();
        //dd($auth);
        $prof = $auth->prof;
        $courss = Cours::where($this->filter(false))
                        ->where('prof_id',$prof->id)
                        ->orderBy($this->orderby, 'desc')
                        ->paginate($this->perpage())
                        ->withPath($this->url_params(true,['cours'=>null]));

        return view('cours.list', [
            'results'=>$courss
        ]);
    }
    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cours.update',[
            'object'=> new Cours(),
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'titre' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'module_id' => 'required|string|max:255',
            'start' => 'required|string|max:255',
            'end' => 'required|string|max:255',
        ]);

        $auth = auth()->user();
        $prof = $auth->prof;

        $cours = Cours::create([
            'titre'=>request('titre'),
            'contenu'=>request('contenu'),
            'type'=>request('type'),
            'prof_id'=>$prof->id,
            'module_id'=>request('module_id'),
            'start'=>request('start'),
            'end'=>request('end')
        ]);
       

       return redirect()
                ->route('cours_edit', $cours->id)
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
        $auth = auth()->user();
        $prof = $auth->prof;

        $cours = Cours::where([
            ['id', $id],
            ['prof_id', $prof->id]
        ])->firstOrFail();

        return view('cours.update', [
            'object'=>$cours
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'titre' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'module_id' => 'required|string|max:255',
            'start' => 'required|string|max:255',
            'end' => 'required|string|max:255',
        ]);
      
        $auth = auth()->user();
        $prof = $auth->prof;

        $cours = Cours::where([
            ['id', $id],
            ['prof_id', $prof->id]
        ])->firstOrFail();

        $cours->titre = request('titre');
        $cours->contenu = request('contenu');
        $cours->type = request('type');
        $cours->prof_id = $prof->id;
        $cours->module_id = request('module_id');
        $cours->start = request('start');
        $cours->end = request('end');

        // save Quiz

        $QQUE = request('QQUE');

        //dd($QQUE);

        if( $QQUE and is_array($QQUE) ){
            foreach ($QQUE as $key => $value) {
                if( is_numeric($key) ){
                    // exists in database we need update it
                    $QQ = Quizquestion::find($key);
                    if( $QQ and $QQ->id ){
                        $QQ->contenu =$value['contenu'];
                        $QQ->reponses = json_encode($value['reponses']);
                        //'type'=> $value['type'],
                        //'cours_id'=> $cours->id,
                        $QQ->save();
                    }
                }else{
                    // new we need add it
                    $QQ = Quizquestion::create([
                        'type'=> $value['type'],
                        'contenu'=> $value['contenu'],
                        'cours_id'=> $cours->id,
                        'reponses'=> json_encode($value['reponses']),
                    ]);
                }
            }
        }

        $cours->save();

        return redirect()
                ->route('cours_edit', $cours->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $auth = auth()->user();
        $prof = $auth->prof;

        $msg = 'delete_error';
        $flash_type = 'error';
        $cours = Cours::where([
            ['id', $id],
            ['prof_id', $prof->id]
        ])->firstOrFail();

        if( $cours->delete() ){            
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('cours')
            ->with($flash_type, __('global.'.$msg));
    }

    /*
     * make all question as readed
     */
    public function question_make_readed()
    {
        $user = auth()->user();
        $prof = $user->prof;
        foreach( $prof->cours as $cour ){
            $ixts = $cour->questions()->where([
                ['user_id', '!=',$user->id],
                ['readed',null],
            ])->update(array('readed' => 1));
        }

        return "ok";
    }

    /*
     * notif unread questions
     */
    public function question_unread()
    {
        $user = auth()->user();
        $prof = $user->prof;

        $data = "";
        foreach( $prof->cours as $cour ){
            $ixts = $cour->questions()->where([
                ['user_id', '!=',$user->id],
                ['readed',null],
            ])->count();
            if($ixts)
                $data .= '<a href="'.route('cours_edit', $cour->id).'?part=descussion" class="dropdown-item d-flex">
                    <span class="avatar avatar-md avatar-green mr-3">'.$ixts.'</span>
                    <div>
                        <strong>'.$ixts.' '.__('cours.unread_questions').'</strong> 
                        <div class="small text-muted">'.$cour.'</div>
                    </div>
                </a>';
        }
        return $data;
        //return [ "msg"=>$html, "id"=>$question->id];
    }

    /*
     * send a question Or reply
     */
    public function add_question($id)
    {
        $user = auth()->user();

        $question = Cours_question::create([
            'contenu'=>request('message'),
            'cours_id'=>$id,
            'user_id'=>$user->id,
            'question_id'=>request('question_id')
        ]);

        $html = "";
        $id = 0;

        if( $question && $question->id ){
            $html = $this->build_message($question);
        }

        return [ "msg"=>$html, "id"=>$question->id];
    }

    /*
     * build a message
     */
    public function build_message($question)
    {
        return '<li class="list-group-item py-5 active" id="Q'.$question->id.'">
          <div class="media">
            <div class="media-object">
              '.$question->user->getavatar().'
            </div>
            <div class="media-body">
              <div class="media-heading">
                <small class="float-left text-muted">'.$question->created_at.'</small>
                <h5><b>'.$question->user.'</b> [ #'.$question->id.' ]</h5>
              </div>
              <div>'.$question->contenu.( ($question->question_id) ? '' : '<br>
                        <a href="javascript:replay('.$question->id.')"  class="btn btn-square btn-secondary">
                          <i class="fa fa-reply" aria-hidden="true"></i>&nbsp;
                          '.__("cours.question_replay").'</a>' ).'
              </div>'.( ($question->question_id) ? '' : '<ul id="media-list-'.$question->id.'" class="media-list" >' ).'
            </div>
          </div>
        </li>';
    }

    
}