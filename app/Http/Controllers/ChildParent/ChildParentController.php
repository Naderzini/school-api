<?php

namespace App\Http\Controllers\ChildParent;

use App\Http\Controllers\Controller;
use App\Repositories\ChildParentRepository;
use Illuminate\Http\Request;
use App\Http\Requests\CreateParent;
use App\Model\ChildParent;


class ChildParentController extends Controller
{
    public function index()
    {
        $allParents = new ChildParentRepository();
        return response()->json(['data' => $allParents->index(),200]);
    }

    public function parentsNumber()
    {
        $nbParents = new ChildParentRepository();
        return response()->json(['data' => $nbParents->parentsNumber(),200]);
    }

    public function parentsMenNumber()
    {
        $nbMenParents = new ChildParentRepository();
        return response()->json(['data' => $nbMenParents->parentsMenNumber(),200]);
    }

    public function parentsWomenNumber()
    {
        $nbWomenParents = new ChildParentRepository();
        return response()->json(['data' => $nbWomenParents->parentsWomenNumber(),200]);
    }

    public function create(CreateParent $request)
    {
        $validateData = $request->validated();
        $cin = $request->input("cin");
        $firstName = $request->input("first_name");
        $lastName = $request->input("last_name");
        $email = $request->input("email");
        $postalCode = $request->input("postal_code");
        $city = $request->input("city");
        $government = $request->input("govarnment");
        $occupation = $request->input("occupation");
        $password = $request->input("password");
        $genre = $request->input("genre");
        $phone = $request->input("phone");
        if($request->hasFile("photo")){
            $photoName = $request->file('photo')->getClientOriginalName();
            $extension = $request->file('photo')->getClientOriginalExtension();
            $photoToStore  = $photoName . '_' . time() . '.' . $extension;
            $path =  $request->file("photo")->storeAs('profileImages',$photoToStore);
        }else{
            $photoToStore= $request->input("photo");
        }
        $parent =  ChildParentRepository::create($cin,$firstName, $lastName, $email, $password, $genre, $photoToStore, $occupation,$postalCode ,$city,$government,$phone);
        return response()->json(['satus'=>'success','data'=>$parent],200);
    }

    public function update(Request $request, $id)
    {
        $cin = $request->input("cin");
        $firstName = $request->input("first_name");
        $lastName = $request->input("last_name");
        $email = $request->input("email");
        $postalCode = $request->input("postal_code");
        $city = $request->input("city");
        $government = $request->input("government");
        $occupation = $request->input("occupation");
        $password = $request->input("password");
        $genre = $request->input("genre");
        $phone = $request->input("phone");
        if($request->hasFile("photo")){
            $photoName = $request->file('photo')->getClientOriginalName();
            $extension = $request->file('photo')->getClientOriginalExtension();
            $photoToStore  = $photoName . '_' . time() . '.' . $extension;
            $path =  $request->file("photo")->storeAs('profileImages',$photoToStore);
        }else{
            $photoToStore= $request->input("photo");
        }
        $parent = new  ChildParentRepository();
        return response()->json(['data'=>$parent->update($cin,$firstName, $lastName, $email, $password, $genre, $photoToStore, $occupation, $postalCode ,$city,$government,$phone,$id)],200);
    }

    public function destroy($id)
    {
        $parent = new ChildParentRepository();
        return response()->json([ 'success' => $parent->destroy($id),200]);
    }

    public function getParents()
    {
        return response()->json(['data' => ChildParent::select('id','cin','first_name','last_name','photo')->get()]);
    }

    public function saveTokenDevice(Request $request,$id){
        $deviceToken = $request->device_token;
        $parent = ChildParentRepository::saveTokenDevice($deviceToken,$id);
        return response()->json(['token saved successfully.' ,'data'=>$parent]);
    }

    public function changePasword(Request $request,$id){
        $password = $request->input("password");
        $parent = new ChildParentRepository();
        return response()->json(['success' => $parent->changePasword($password,$id),200]);
    }
}
