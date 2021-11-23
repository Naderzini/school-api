<?php

namespace App\Http\Controllers\SchoolEvent;

use App\Repositories\SchoolEventRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\SchoolEvent;

class SchoolEventController extends Controller
{
    public function index()
    {
        $event = new SchoolEventRepository();
        return response()->json(['data' => $event->index(),200]);
    }

    public function create(Request $request)
    {
        $name = $request->input("name");
        $date = $request->input("date");
        $description = $request->input("description");
        if($request->hasFile("photo")){
            $photoName = $request->file('photo')->getClientOriginalName();
            $extension = $request->file('photo')->getClientOriginalExtension();
            $photoToStore  = $photoName . '_' . time() . '.' . $extension;
            $path =  $request->file("photo")->storeAs('EventsPhoto',$photoToStore);
        }else{
            $photoToStore= $request->input("photo");
        }
        $event = SchoolEventRepository::create($name,$date,$description,$photoToStore);
        return response()->json(['satus'=>'success','data'=>$event],200);
    }

    public function destroy($id)
    {
       $event = new SchoolEventRepository();
        return response()->json(['success' =>$event->destroy($id),200]);
    }

    public function getAllEventsMobile(){
        $event = new SchoolEventRepository();
        return response()->json(['data' => $event->getAllEventsMobile(),200]);
    }
}
