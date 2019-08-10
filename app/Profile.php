<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable=['user_id','about','avatar','facebook','youtube'];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function getavatarAttribute($avatar){
        return asset($avatar);
    }
}
