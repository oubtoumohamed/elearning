<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cours_question extends Model
{
    protected $fillable = [
        'contenu','cours_id','user_id','question_id','readed'
    ];



    public function __toString(){
        return ( $this->id ) ? "#".$this->id : "";
    }

    public function cours(){
        return $this->belongsTo('App\Cours');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function reponses(){
        return $this->hasMany('App\Cours_question','question_id');
    }

    public function getcontenu(){
        return $this->contenu;
    }
    
    public function getreaded(){
        return $this->readed;
    }

}
