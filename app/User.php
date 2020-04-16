<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','role','password','email','avatar','phone','cin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function __toString(){
        return ( $this->id ) ? $this->name : "";
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('user_edit',$this->id).'" target="_blank">'.$this->name.'</a>' : "";
    }
    
    public function etudient(){
        return $this->hasOne('App\Etudient');
    }
    public function prof(){
        return $this->hasOne('App\Prof');
    }

    public function groupes(){
        return $this->belongsToMany('App\Groupe','usergroupes','user_id');
    }

    public function picture(){
        return $this->belongsTo('App\Media','avatar','id');
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function avatar(){
        return  '<span class="avatar">' . ($this->picture ? $this->picture->reference : substr($this->name, 0, 2) ).'</span>';
    }

    public function roles(){
        $roles = [];
        $roles[] = $this->role;

        foreach ($this->groupes as $groupe) {
            foreach (explode(',', $groupe->roles) as $role) {
                array_push($roles, strtolower($role) );
            }
        }
        return $roles;
    }
    
    public function isGranted($role){

        if($this->role == "ADMIN" && $role != "PROF" && $role != "ETUDIENT")
            return true;

        if(
            $this->role == "PROF" 
            && preg_grep ("/^$role(.*)/i", [
                "PROF","cours"
            ]) 
        )
            return true;

        //if($this->role == "ETUDIENT" && $role == "ETUDIENT")
        if(
            $this->role == "ETUDIENT" 
            && preg_grep ("/^$role(.*)/i", [
                "ETUDIENT","cours_show"
            ])
        ){
            return true;
        }

        $roles = $this->roles();
        
        if( in_array( strtolower($role), $roles) )
            return true;


        return false;
    }
    
    /*public function isGranted($role){
        if( $this->role == $role )
            return true;
        
        return false;
    }*/

    public function getname(){
        return $this->name;
    }

    public function getrole(){
        return $this->role;
    }

    public function getemail(){
        return $this->email;
    }
    public function getphone(){
        return $this->phone;
    }

    public function getcin(){
        return $this->cin;
    }
    public function getgroupes(){
        $this->groupes_html = "";

        foreach ($this->groupes as $groupe) {
            $this->groupes_html .= $groupe->__toHtml()." <br> ";
        }
        return $this->groupes_html;
    }

    public function scopeGroupe($query)
    {
        global $filter;
        $filter = request('filter');

        if( $filter["groupes"] and $filter["groupes"]['value'] ){
            return $query->whereHas('groupes', function ($query) {
                global $filter;


                $query->where('groupe_id', $filter["groupes"]['value']);
            });
        }
    }

    public function getcne(){
        if($this->etudient)
            return $this->etudient->cne;
        if($this->prof)
            return $this->prof->matricule;
    }

    public function getavatar($size="lg"){
        return $this->picture ? $this->getavatarlink($size): $this->getavatartext($size);
    }

    public function getavatartext($size="lg"){
        return $this->picture ? '' : '<span class="avatar avatar-'.$size.' avatar-blue mr-4">'.substr($this->name, 0, 2).'</span>';
    }

    public function getavatarlink($size="lg"){
        return $this->picture ? '<span class="avatar avatar-'.$size.' avatar-blue mr-4" style="background-image: url(\''.$this->picture->link().'\' )"></span>' : '';
    }

    public function getavatarfulllink(){
        return $this->picture ? $this->picture->link() : '';
    }
}
