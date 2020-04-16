<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Module;

class Etudient extends Model
{
    protected $fillable = [
        'cne','user_id'
    ];

    public function __toString(){
        return ( $this->id ) ? $this->user : "";
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('etudient',$this->id).'" target="_blank">'.$this->user.'</a>' : "";
    }

    public function scopeUserdata($query)
    {
        global $filter;
        $filter = request('filter');

        if( 
            ( $filter["name"] and $filter["name"]['value'] ) || 
            ( $filter["cin"] and $filter["cin"]['value'] ) || 
            ( $filter["email"] and $filter["email"]['value'] ) || 
            ( $filter["phone"] and $filter["phone"]['value'] )
        ){

            return $query->whereHas('user', function ($query) {
                global $filter;
                $where = [];


                if( $filter["name"] and $filter["name"]['value'] )
                    $where[] = [ 
                            "name" 
                            ,'like',
                            "%".$filter["name"]['value'] ."%"
                        ];

                if( $filter["cin"] and $filter["cin"]['value'] )
                    $where[] = [ 
                            "cin" 
                            ,'like',
                            "%".$filter["cin"]['value']."%"
                        ];

                if( $filter["email"] and $filter["email"]['value'] )
                    $where[] = [ 
                            "email" 
                            ,'like',
                            "%".$filter["email"]['value']."%"
                        ];

                if( $filter["phone"] and $filter["phone"]['value'] )
                    $where[] = [ 
                            "phone" 
                            ,'like',
                            "%".$filter["phone"]['value']."%"
                        ];

                $query->where($where);
            });
        }
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function etudient_filiers(){
        return $this->hasMany('App\Etudient_filier');
    }

    public function filiers(){
        return $this->belongsToMany('App\Filier','etudient_filiers');
    }

    public function filier__s(){
        return $this->filiers()->orderBy('year','desc')->take(1);
    }

    public function filier(){
        return $this->filier__s->first();
    }

    public function modules_ids(){
        $ids = [];

        if( $this->filier() ){
            foreach( Module::where('filier_id', $this->filier()->id)->get() as $mdl ){
                $ids[$mdl->id] = $mdl->id;
            }
        }

        foreach( $this->modules as $mdle ){
            $ids[$mdle->id] = $mdle->id;
        }

        return $ids;
    }
        
    public function etudient_modules(){
        return $this->hasMany('App\Etudient_module');
    }

    public function modules(){
        return $this->belongsToMany('App\Module','etudient_modules');
    }

    public function getcne(){
        return $this->cne;
    }
    public function getname(){
        return $this->user->getname();
    }

    public function getrole(){
        return $this->user->getrole();
    }

    public function getemail(){
        return $this->user->getemail();
    }
    public function getphone(){
        return $this->user->getphone();
    }

    public function getcin(){
        return $this->user->getcin();
    }

    public function getavatar($size="lg"){
        return $this->user->getavatar($size);
    }

    public function Json(){
        return [
            'id' => $this->id,
            'user_id' => $this->user->id,
            'name' => $this->user->getname(),
            'role' => $this->user->getrole(),
            'email' => $this->user->getemail(),
            'avatar' => $this->user->getavatarfulllink(),
            'phone' => $this->user->getphone(),
            'cin' => $this->user->getcin(),
            'cne' => $this->getcne(),

            'filier' => $this->filier(),
            'joined_modules' => $this->modules,
        ];
    }
}
