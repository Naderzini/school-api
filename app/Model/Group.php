<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{

    public function childrens(){
        return  $this->hasMany(Childrens::Class);
        }
    public function subjects(){
        return $this->belongsToMany(Subject::Class);
    }
    public function teachers(){
        return $this->belongsToMany(Teacher::class);
    }
}
