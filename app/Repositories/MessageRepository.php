<?php

namespace App\Repositories;

use App\Model\Message;
use App\Model\Admin;
use App\Services\MessageAdminNotification;
use App\Services\MessageParentNotification;
use Illuminate\Support\Facades\Auth;

class MessageRepository
{
     /**
      *
      * @param string $content
      * @return Message
      */
    public function index($id)
    {
        return Message::where('child_parent_id',$id)->get();
    }

    public static function create($content,$admin_id,$parent_id)
     {
        $message = new Message();
        $message->content = $content;
        $message->child_parent_id=$parent_id;
        $message->admin_id=$admin_id;
        $message->save();

        if($admin_id != null){
            $ntf = new MessageAdminNotification();
            $ntf->sendNotification("message",$content,"message",$parent_id);
        }else{
            $ntf = new MessageParentNotification();
            $ntf->sendNotification("message",$content,"message");
        }
        return $message;
     }
}
