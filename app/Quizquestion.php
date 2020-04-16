<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quizquestion extends Model
{
    public $data;

    protected $fillable = [
        'contenu','cours_id', 'type', 'reponses'
    ];

    public function __toString(){
        return ( $this->id ) ? "#".$this->id : "";
    }

    public function cours(){
        return $this->belongsTo('App\Cours');
    }

    public function getcontenu(){
        return $this->contenu;
    }

    public function getcours_id(){
        return $this->cours;
    }

    public function gettype(){
        return $this->type;
    }

    public function getreponses(){
        return json_decode($this->reponses, false);
    }

    public function getprof_id(){
        return $this->cours->prof_id;
    }

    public function getmodule_id(){
        return $this->cours->module;
    }

    public function build_reponse_type(){
        return ($this->type == 'multiple') ? 'checkbox' : 'radio';
    }

    public function build_reponse_correct($i){
        return ( $this->type == 'multiple' ) ? '['.$i.']' : '';
    }

    public function build_reponse_correct_check($i,$correct){
        if( $this->type == 'multiple' )
            return ( property_exists($correct, $i) ) ? 'checked="checked"' : '';
        else
            return ($i == $correct) ? 'checked="checked"' : '';
    }

    public function build_reponses(){        
        $repons = $this->getreponses();
        $i = 1;
        $h = "";
        foreach ($repons->data as $key => $value) {
            $h .= '<div class="item">
                <div class="input-group">
                  <span class="input-group-prepend">
                    <span class="input-group-text">
                        <input type="hidden" value="'.$this->type.'" name="QQUE['.$this->id.'][type]">
                        <input type="'.$this->build_reponse_type().'" value="'.$i.'" name="QQUE['.$this->id.'][reponses][correct]'.$this->build_reponse_correct($i).'" class="input-group-text" '.$this->build_reponse_correct_check($i, $repons->correct).'>
                    </span>
                  </span>
                  <input type="text" name="QQUE['.$this->id.'][reponses][data]['.$key.']" class="form-control" value="'.$value.'">
                </div>
            </div>';
            $i++;
        }

        return $h;
    }



}
