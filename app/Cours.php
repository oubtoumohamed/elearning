<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    protected $fillable = [
        'titre','contenu','type', 'prof_id','module_id','start','end'
    ];

    public function __toString(){
        return ( $this->id ) ? $this->titre : "";
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('cours',$this->id).'" target="_blank">'.$this->titre.'</a>' : "";
    }

    public function module(){
        return $this->belongsTo('App\Module');
    }

    public function prof(){
        return $this->belongsTo('App\Prof');
    }

    public function questions(){
        return $this->hasMany('App\Cours_question')->where('question_id',NULl);
    }

    public function quizquestions(){
        return $this->hasMany('App\Quizquestion');
    }

    public function gettitre(){
        return $this->titre;
    }

    public function gettype(){
        return $this->type;
    }

    public function tagtype(){
        if($this->type == 'Cours')
            return '<span class="tag tag-success">Cours</span>';
        if($this->type == 'TP')
            return '<span class="tag tag-danger">TP</span>';
        if($this->type == 'TD')
            return '<span class="tag tag-warning">TD</span>';
    }

    public function getcontenu(){
        $txt = str_replace('oembed url', 'iframe src', $this->contenu);
        $txt = str_replace('oembed', 'iframe', $txt );
        $txt = str_replace('https://www.youtube.com/watch?v=', 'https://www.youtube.com/embed/', $txt );
        // files pdf ppt....
        $txt = str_replace('<iframe class="ifrm"', '<embed ', $txt );
        $txt = str_replace('frameborder="0"></iframe>', '></embed>', $txt );

        return $txt;
    }

    public function getprof_id(){
        return $this->prof_id;
    }

    public function getmodule_id(){
        return $this->module;
    }

    public function getstart(){
        return $this->start;
    }

    public function getend(){
        return $this->end;
    }

}
