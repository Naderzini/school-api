<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{

    // protected $dateFormat = 'U';
    public function groups(){
        return $this->belongsToMany(Group::Class);
    }

    public function teachers(){
        return $this->hasMany(Teacher::class);
    }

}
