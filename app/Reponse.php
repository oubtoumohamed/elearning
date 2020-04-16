<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    protected $fillable = [
        'contenu','user_id','question_id'
    ];

    public function __toString(){
        return ( $this->id ) ? $this->contenu : "";
    }
    public function getcontenu(){
        return $this->contenu;
    }
    public function getuser_id(){
        return $this->user;
    }
    public function getquestion_id(){
        return $this->question;
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function question(){
        return $this->belongsTo('App\Question');
    }
}
