<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\ChildParent;
use App\Model\Group;

class Children extends Model
{
    // use SoftDeletes;
    // protected $dateFormat = 'U';
    public function childParent(){
        return $this->belongsTo(ChildParent::class);
    }
    public function group(){
        return $this->belongsTo(Group::Class);
    }

}
