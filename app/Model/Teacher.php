<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function groups(){
        return $this->belongsToMany(Group::class);
    }
    public function subject(){
        return $this->belongsTo(Subject::class);
    }
}
