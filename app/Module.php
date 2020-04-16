<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    //
    protected $fillable = [
        'name','description','ref','semester_id','filier_id'
    ];

    public function __toString(){
        return ( $this->id ) ? $this->ref . ' - ' . $this->name : "";
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('module',$this->id).'" target="_blank">'.$this->ref.'</a>' : "";
    }


    public function getname(){
    	return $this->name;
    }

    public function getref(){
        return $this->ref;
    }

    public function getdescription(){
        return $this->description;
    }

    public function getsemester_id(){
        return $this->semester;
    }

    public function getfilier_id(){
        return $this->filier;
    }

    public function semester(){
        return $this->belongsTo('App\Semester');
    }
    public function filier(){
        return $this->belongsTo('App\Filier');
    }

}
