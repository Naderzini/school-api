<?php

namespace App\Http\Controllers\ChildParent;

use App\Model\ChildParent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ResetPassword;


class ForgetPasswordController extends Controller
{
    public function resetPassword()
    {
       $email = request()->get("email");
       $parent = ChildParent::query()->where('email',$email)->first();
        if($parent !== null) {
            $password = Str::random(8);
            $parent->setPassword($password);
            Mail::to($email)->send(new ResetPassword($password));
            return response()->json([
                'success' => true,
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Email invalide.'
            ]);
         }


    }

}
