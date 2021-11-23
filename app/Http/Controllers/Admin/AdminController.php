<?php

namespace App\Http\Controllers\Admin;


use App\Repositories\AdminRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateAdmin;
use App\Model\Admin;


class AdminController extends Controller
{

    public function index()
    {
        $allAdmins = new AdminRepository();
        return response()->json(['data' => $allAdmins->index(),200]);
    }

    public function adminsNumber()
    {
        $nbAdmins = new AdminRepository();
        return response()->json(['data' => $nbAdmins->adminsNumber(),200]);
    }

    public function findAdmin($firstName)
    {
        $admins = new AdminRepository();
        return response()->json(['data' => $admins->findAdmin($firstName),200]);
    }

    public function create(CreateAdmin $request)
    {
        $validateData = $request->validated();
        $firstName = $request->input("first_name");
        $lastName = $request->input("last_name");
        $email = $request->input("email");
        $password = $request->input("password");
        $phone = $request->input("phone");
        if($request->hasFile("photo")){
            $photoName = $request->file('photo')->getClientOriginalName();
            $extension = $request->file('photo')->getClientOriginalExtension();
            $photoToStore  = $photoName . '_' . time() . '.' . $extension;
            $path =  $request->file("photo")->storeAs('profileImages',$photoToStore);
        }else{
            $photoToStore= $request->input("photo");
        }
        $admin = AdminRepository::create($firstName, $lastName, $email, $password, $phone, $photoToStore);
        return response()->json(['satus'=>'success','data'=>$admin],200);
    }

    public function update(Request $request, $id)
    {
        $firstName = $request->input("first_name");
        $lastName = $request->input("last_name");
        $email = $request->input("email");
        $password = $request->input("password");
        $phone = $request->input("phone");
        if($request->hasFile("photo")){
            $photoName = $request->file('photo')->getClientOriginalName();
            $extension = $request->file('photo')->getClientOriginalExtension();
            $photoToStore  = $photoName . '_' . time() . '.' . $extension;
            $path =  $request->file("photo")->storeAs('profileImages',$photoToStore);
        }else{
            $photoToStore= $request->input("photo");
        }
        $admin = new AdminRepository();
        return response()->json(['data'=>$admin->update($firstName, $lastName, $email, $password, $phone, $photoToStore,$id)],200);
    }

    public function destroy($id)
    {
        $admin = new AdminRepository();
        return response()->json(['success' => $admin->destroy($id),200]);
    }

    public function saveToken(Request $request,$id)
    {
        $deviceToken = $request->device_token;
        $admin = AdminRepository::saveToken($deviceToken,$id);
        return response()->json(['token saved successfully.' ,'data'=>$admin]);
    }

    public function changePasword(Request $request,$id){
        $password = $request->input("password");
        $admin = new AdminRepository();
        return response()->json(['success' => $admin->changePasword($password,$id),200]);
    }
}
