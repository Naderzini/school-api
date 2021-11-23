<?php

namespace App\Repositories;

use App\Model\Group;
use App\Model\Subject;

class GroupRepository
{

    public function index()
    {
        return Group::orderBy('created_at','desc')->paginate(10);
    }

    public static function create($groupName,$subject_ids,$PlanToStore)
    {
        $group = new Group();
        $group->name = $groupName;
        $group->joint = $PlanToStore;
        $group->save();
        $group->subjects()->sync($subject_ids);
        return $group;
    }

    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        $group->delete();
        return  true;
    }

    public function getGroups()
    {
        return  Group::select('id','name')->get();
    }
}
