<?php

namespace App\Http\Controllers\Teacher;

use App\Repositories\TeacherRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Teacher;
use App\Http\Requests\CreateTeacher;

class TeacherController extends Controller
{
    public function index()
    {
        $teacher = new TeacherRepository();
        return response()->json(['data' => $teacher->index(),200]);
    }

    public function techersMenNumber()
    {
        $nbMenTeachers = new TeacherRepository();
        return response()->json(['data' => $nbMenTeachers->techersMenNumber(),200]);
    }

    public function teachersWomenNumber()
    {
        $nbWomenTeachers = new TeacherRepository();
        return response()->json(['data' => $nbWomenTeachers->teachersWomenNumber(),200]);
    }

    public function teachersNumber()
    {
        $nbTeachers = new TeacherRepository();
        return response()->json(['data' => $nbTeachers->teachersNumber(),200]);
    }

    public function create(CreateTeacher $request)
    {
        $validateData = $request->validated();
        $firstName = $request->input("first_name");
        $lastName = $request->input("last_name");
        $email = $request->input("email");
        $subject = $request->input("subject");
        $genre = $request->input("genre");
        $group_ids = $request->input("group_ids");
        $teacher = TeacherRepository::create($firstName,$lastName,$email,$subject,$genre,$group_ids);
        return response()->json(['satus'=>'success','data'=>$teacher],200);
    }

    public function update(Request $request, $id)
    {
        $firstName = $request->input("first_name");
        $lastName = $request->input("last_name");
        $email = $request->input("email");
        $subject = $request->input("subject");
        $genre = $request->input("genre");
        $group_ids = $request->input("group_ids");
        $teacher = TeacherRepository::update($firstName,$lastName,$email,$subject,$genre,$group_ids,$id);
        return response()->json(['satus'=>'success','data'=>$teacher],200);
    }

    public function destroy($id)
    {
        $teacher =new TeacherRepository();
        return response()->json(['success' => $teacher->destroy($id),200]);
    }

}
