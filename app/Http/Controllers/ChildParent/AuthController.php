<?php

namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers\ChildParent;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\ChildParent;
class AuthController extends Controller
{
    public function loginParent(Request $request)
    {
        $input = $request->only('email', 'password');
        $token = null;
        $parent = ChildParent::where('email',$request->email)->first();
        if($token = Auth::guard('childparent')->attempt($input)){
            return response()->json([
                'success' => true,
                'token' => $token,
                'parent' =>$parent,
        ]);
    }
    return response()->json([
        'success' => false,
        'token' => null
    ]);
    }
}
