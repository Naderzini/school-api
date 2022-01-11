<?php

namespace App\Repositories;

use App\Model\Subject;

class SubjectRepository
{
     /**
      *
      * @param string $subjectName;
      * @param string $subjectCode;
      * @param string $hoursWeek;
      * @return Subject
      */
    public function index()
    {
      return  Subject::orderBy('created_at','desc')->paginate(10);
    }

    public static function create($subjectName,$subjectCode,$hoursWeek)
    {
        $subject = new Subject();
        $subject->code = $subjectCode;
        $subject->name = $subjectName;
        $subject->hours_week = $hoursWeek;
        $subject->save();
        return $subject;
    }

    public static function update($subjectName,$subjectCode,$hoursWeek,$id)
    {
        $subject = Subject::findOrFail($id);
        $subject->code = $subjectCode;
        $subject->name = $subjectName;
        $subject->hours_week = $hoursWeek;
        $subject->save();
        return $subject;
    }

    public function destroy($id){
        $subject = Subject::findOrFail($id);
        $subject->delete();
        return true;
    }

    public function getSubjects (){
        return Subject::select('id','code','name')->get();
    }

}
