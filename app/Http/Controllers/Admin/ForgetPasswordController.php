<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin;
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
       $admin = Admin::query()->where('email',$email)->first();
        if($admin !== null) {
            $password = Str::random(8);
            $admin->setPassword($password);
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
