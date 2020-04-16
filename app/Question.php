<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	protected $fillable = [
        'titre','contenu','photo','user_id'
    ];

    public function __toString(){
        return ( $this->id ) ? $this->titre : "";
    }
   	public function gettitre(){
        return $this->titre;
    }
    public function getcontenu(){
        return $this->contenu;
    }
    public function getuser_id(){
        return $this->user;
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function picture(){
        return $this->belongsTo('App\Media','photo','id');
    }
    public function getavatar(){
        return $this->picture ? $this->picture->picture() : '<span class="avatar">'.substr($this->titre, 0, 2).'</span>';
    }
}
