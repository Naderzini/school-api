<?php

namespace App\Http\Controllers\Children;

use App\Http\Controllers\Controller;
use App\Repositories\ChildrenRepository;
use Illuminate\Http\Request;
use App\Model\Children;

class ChildrenController extends Controller
{
    public function index()
    {
        $children = new ChildrenRepository();
        return response()->json([ 'data' => $children->index() ,200]);
    }

    public function childrensNumber()
    {
        $nbChildrens = new ChildrenRepository();
        return response()->json(['data' => $nbChildrens->childrensNumber(),200]);
    }

    public function create(Request $request)
    {
        $firstName = $request->input("first_name");
        $lastName = $request->input("last_name");
        $age = $request->input("age");
        $child_parent_id = $request->input("parent_id");
        $group_id = $request->input("group_id");
        if($request->hasFile("photo")){
            $photoName = $request->file("photo")->getClientOriginalName();
            $extension = $request->file("photo")->getClientOriginalExtension();
            $photoToStore  = $photoName . '_' . time() . '.' . $extension;
            $path =  $request->file("photo")->storeAs('profileImages',$photoToStore);
        }else{
            $photoToStore= $request->input("photo");}
        $children =  ChildrenRepository::create($firstName, $lastName, $age, $child_parent_id,$group_id,$photoToStore);
        return response()->json(['satus'=>'success','data'=>$children],200);
    }

    public function update(Request $request, $id)
    {
        $firstName = $request->input("first_name");
        $lastName = $request->input("last_name");
        $age = $request->input("age");
        $photo = $request->input("photo");
        $child_parent_id = $request->input("parent_id");
        $group_id = $request->input("group_id");
        if($request->hasFile("photo")){
            $photoName = $request->file("photo")->getClientOriginalName();
            $extension = $request->file("photo")->getClientOriginalExtension();
            $photoToStore  = $photoName . '_' . time() . '.' . $extension;
            $path =  $request->file("photo")->storeAs('profileImages',$photoToStore);
        }else{
            $photoToStore= $request->input("photo");}
        $children =  ChildrenRepository::update($firstName, $lastName, $age, $photo, $child_parent_id,$group_id,$id, $photoToStore);
        return response()->json(['satus'=>'success','data'=>$children],200);
    }

    public function destroy($id)
    {
        $children = new ChildrenRepository();
        return response()->json(['success' => $children->destroy($id),200]);
    }

    public function getMyChildrens($id)
    {
        $children = new ChildrenRepository();
        return response()->json([ 'data' => $children-> getMyChildrens($id),200]);
    }

    public function getChildrenSubjects($id)
    {
        $children = new ChildrenRepository();
        return response()->json(['success' => $children->getChildrenSubjects($id),200]);
    }

    public function getChildrenTeachers($id)
    {
    $children = new ChildrenRepository();
    return response()->json(['success' => $children->getChildrenTeachers($id),200]);
    }
}
