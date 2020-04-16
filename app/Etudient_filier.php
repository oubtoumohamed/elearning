<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etudient_filier extends Model
{
    //
    protected $fillable = [
        'etudient_id','filier_id','year' 	
    ];


    public function filier(){
        return $this->belongsTo('App\Filier');
    }
    
}
