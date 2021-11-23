<?php

namespace App\Http\Controllers\Group;

use App\Repositories\GroupRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Group;
use App\Model\Subject;
class GroupController extends Controller
{
    public function index()
    {
        $group = new GroupRepository();
        return response()->json(['data' =>$group->index(),200]);
    }

    public function create(Request $request)
    {
        $groupName = $request->input("group_name");
        $subject_ids = $request->input("subject_ids");
        if($request->hasFile("plan")){
            $planName = $request->file("plan")->getClientOriginalName();
            $extension = $request->file("plan")->getClientOriginalExtension();
            $planToStore  = $planName . '_' . time() . '.' . $extension;
            $path =  $request->file("plan")->storeAs('plans',$planToStore);
        }else{
            $planToStore= $request->input("plans");}
        $group = GroupRepository::create($groupName,$subject_ids,$planToStore);
        return response()->json(['satus'=>'success','data'=>$group],200);
    }

    public function destroy($id)
    {
        $group = new GroupRepository();
        return response()->json(['data' => $group->destroy($id),200]);
    }

    public function getGroups()
    {
        $group = new GroupRepository();
        return response()->json(['data' => $group->getGroups()]);
    }

}
