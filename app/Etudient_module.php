<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etudient_module extends Model
{
    //
    protected $fillable = [
        'etudient_id','module_id','date_affect' 	
    ];


    public function module(){
        return $this->belongsTo('App\Module');
    }
    
}
