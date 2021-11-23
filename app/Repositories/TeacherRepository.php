<?php

namespace App\Repositories;

use App\Model\Teacher;

class TeacherRepository
{
     /**
      *
      * @param string $firstName;
      * @param string $lastName;
      * @param string $email
      * @param string $subject
      * @param string $genre
      *
      * @return Teacher
      */
    public function index()
    {
      return  Teacher::orderBy('created_at','desc')->paginate(10);
    }

    public static function create($firstName, $lastName, $email, $subject, $genre,$group_ids)
     {
        $teacher = new Teacher();
        $teacher->first_name = $firstName;
        $teacher->last_name = $lastName;
        $teacher->email = $email;
        $teacher->subject = $subject;
        $teacher->genre = $genre;
        $teacher->save();
        $teacher->groups()->sync($group_ids);
        return $teacher;
     }

    public static function  Update($firstName, $lastName, $email, $subject, $genre,$group_ids,$id)
     {
        $teacher = Teacher::findOrFail($id);
        $teacher->first_name = $firstName;
        $teacher->last_name = $lastName;
        $teacher->email = $email;
        $teacher->subject = $subject;
        $teacher->genre = $genre;
        $teacher->save();
        $teacher->groups()->sync($group_ids);
        return $teacher;
     }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();
        return true;
    }

    public function teachersNumber()
    {
        return Teacher::count();
    }

    public function techersMenNumber()
    {
      return Teacher::where('genre', '=','homme')->count();
    }

    public function TeachersWomenNumber()
    {
       return Teacher::where('genre', '=','femme')->count();
    }
}
