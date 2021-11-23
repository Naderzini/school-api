<?php

namespace App\Repositories;

use App\Model\Children;

class ChildrenRepository
{
     /**
      *
      * @param string $firstName;
      * @param string $lastName;
      * @param int $age
      * @param string|null $photoToStore
      * @param int $parent_id
      *
      * @return Children
      */
    public function index(){
       return Children::orderBy('created_at','desc')->with('childParent')->with('group')->paginate(10);
    }

    public function childrensNumber()
    {
        return Children::count();
    }

    public static function create($firstName, $lastName, $age, $child_parent_id,$group_id, $photoToStore)
    {
        $children = new Children();
        $children->first_name = $firstName;
        $children->last_name = $lastName;
        $children->age = $age;
        $children->photo = $photoToStore;
        $children->child_parent_id = $child_parent_id;
        $children->group_id = $group_id;
        $children->save();
        return $children;
    }

    public static function  Update($firstName, $lastName, $age, $photo, $child_parent_id,$group_id,$id, $photoToStore)
    {
        $children = Children::findOrFail($id);
        $children->first_name = $firstName;
        $children->last_name = $lastName;
        $children->age = $age;
        $children->photo = $photoToStore;
        $children->child_parent_id = $child_parent_id;
        $children->group_id = $group_id;
        $children->save();
        return $children;
    }

    public function getMyChildrens($id)
    {
        return Children::where('child_parent_id', $id)->orderBy('created_at','desc')->with('group')->get();

    }

    public function destroy($id){
        $children = Children::findOrFail($id);
        $children->delete();
        return true;
    }

    public function getChildrenSubjects($id)
    {
        $children = Children::findOrFail($id);
        return $children->group->subjects;
    }

    public function getChildrenTeachers($id)
    {
       $children = Children::findOrFail($id);
       return $children->group->teachers;
  }
}
