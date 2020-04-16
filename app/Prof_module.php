<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prof_module extends Model
{
    //
    protected $fillable = [
        'prof_id','module_id','date_affect' 	
    ];


    public function module(){
        return $this->belongsTo('App\Module');
    }
}
