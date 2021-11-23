<?php

namespace App\Http\Controllers\Subject;

use App\Repositories\SubjectRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Subject;
use App\Http\Requests\CreateSubject;

class SubjectController extends Controller
{
    public function index()
    {
        $subject = new SubjectRepository();
        return response()->json(['data' => $subject->index() ,200]);
    }

    public function create(CreateSubject $request)
    {
        $validateData = $request->validated();
        $subjectCode = $request->input("code");
        $subjectName = $request->input("subject_name");
        $hoursWeek = $request->input("hours_week");
        $subject = SubjectRepository::create($subjectName,$subjectCode,$hoursWeek);
        return response()->json(['satus'=>'success','data'=>$subject],200);
    }

    public function destroy($id)
    {
        $subject = new SubjectRepository();
        return response()->json(['success' => $subject->destroy($id),200]);
    }

    public function getSubjects(){
        $subject = new SubjectRepository();
        return response()->json(['data' => $subject->getSubjects(),200]);
    }
}
