<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cours_question extends Model
{
    protected $appends = array(
        'message',
        'auteur',
        'date',
    );

    public function getMessageAttribute()
    {
        return $this->contenu;
    }

    public function getAuteurAttribute()
    {
        return $this->user->__toString();
    }

    public function getDateAttribute()
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }
    
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
