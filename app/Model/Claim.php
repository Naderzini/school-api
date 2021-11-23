<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\ChildParent;

class Claim extends Model
{
    public function childParent(){
        return $this->belongsTo(ChildParent::class);
    }
}
