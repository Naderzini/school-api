<?php

namespace App\Repositories;


use App\Model\Claim;
use App\Services\ClaimNotification;
use App\Model\Admin;

class ClaimRepository
{
     /**
      *
      * @param string $content;
      *
      * @return Claim
      */
    public function index()
      {
          return Claim::orderBy('created_at','desc')->with('childParent')->paginate(10);
      }

     public static function create($content,$child_parent_id,$title)
     {
        $claim = new Claim();
        $claim->content = $content;
        $claim->child_parent_id = $child_parent_id;
        $claim->title = $title;
        $claim->save();
        $ntf = new ClaimNotification();
        $ntf->sendNotification("Reclamation",$content,"Reclamation");
        return $claim;
     }

     public function update($status,$answer,$id)
     {
        $claim = Claim::findOrFail($id);
        $claim->statue = $status;
        $claim->answer = $answer;
        $claim->save();
        return $claim;
     }

     public function destroy($id){
        $claim = Claim::findOrFail($id);
        $claim->delete();
        return true;
     }

     public function getMyClaims($id){
        $claim = new ClaimRepository();
        return Claim::orderBy('created_at','desc')->where('child_parent_id', $id)->get();
    }



}
