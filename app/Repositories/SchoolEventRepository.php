<?php

namespace App\Repositories;

use App\Model\SchoolEvent;
use App\Services\EventNotification;

class SchoolEventRepository
{
     /**
      *
      * @param string $name;
      * @param date $date;
      * @param string $description
      * @param string $photoToStore
      * @return SchoolEvent
      */
    public function index()
    {
       return SchoolEvent::orderBy('created_at','desc')->paginate(10);
    }

    public static function create($name,$date,$description,$photoToStore)
    {
        $event = new SchoolEvent();
        $event->name = $name;
        $event->date = $date;
        $event->description = $description;
        $event->photo=$photoToStore;
        $event->save();
        $ntf = new EventNotification();
        $ntf->sendNotification("Événement","Invitation a un événement","Evenement");
        return $event;
    }

    public function destroy($id)
    {
        $event = SchoolEvent::findOrFail($id);
        $event->delete();
        return true;
    }

    public function getAllEventsMobile(){
        return SchoolEvent::orderBy('created_at','desc')->get();
    }
}
