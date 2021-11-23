<?php

namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin;
class AuthController extends Controller
{

    public function loginAdmin(Request $request)
    {
        $input = $request->only('email', 'password');
        $token = null;
        $admin = Admin::where('email',$request->email)->first();
        if($token = Auth::guard('admin')->attempt($input)){
            return response()->json(['success' => true,'token' => $token,'admin'  =>$admin,]);
        }
        return response()->json([
        'success' => false,'err' => 'Invalid email or password ']);
    }
}
