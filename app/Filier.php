<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filier extends Model
{
    //
    protected $fillable = [
        'name','description'
    ];

    public function __toString(){
        return ( $this->id ) ? $this->name : "";
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('filier',$this->id).'" target="_blank">'.$this->name.'</a>' : "";
    }


    public function getname(){
    	return $this->name;
    }

    public function getdescription(){
        return $this->description;
    }

}
