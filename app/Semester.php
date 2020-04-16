<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    //
    protected $fillable = [
        'name'
    ];

    public function __toString(){
        return ( $this->id ) ? $this->name : "";
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('semester',$this->id).'" target="_blank">'.$this->name.'</a>' : "";
    }


    public function getname(){
    	return $this->name;
    }

}
