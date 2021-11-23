<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\ChildParent;
use App\Model\Admin;

class Message extends Model
{
    public function childParent(){
        return $this->belongsTo(ChildParent::class);
    }
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
