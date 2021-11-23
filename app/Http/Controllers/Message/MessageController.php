<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\MessageRepository;
use App\Model\Message;

class MessageController extends Controller
{
    public function index($id)
    {
        $message = new MessageRepository();
        return response()->json(['data' => $message->index($id) ,200]);
    }

    public function create(Request $request)
    {
        $content = $request->input("content");
        $admin_id = $request->input('admin_id');
        $parent_id = $request->input('parent_id');
        $message = MessageRepository::create($content,$admin_id,$parent_id);
        return response()->json(['satus'=>'success','data'=>$message],200);
    }


}
