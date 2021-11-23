<?php

namespace App\Http\Controllers\Claim;

use App\Repositories\ClaimRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Claim;

class ClaimController extends Controller
{
    public function index()
    {
        $claim = new ClaimRepository();
        return response()->json(['data' => $claim->index() ,200]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required',
            ]);
        $title = $request->input("title");
        $content = $request->input("content");
        $child_parent_id = $request->input("parent_id");
        $claim = ClaimRepository::create($content,$child_parent_id,$title);
        return response()->json(['satus'=>'success','data'=>$claim],200);
    }

    public function update(Request $request, $id)
    {
        $status = $request->input("status");
        $answer = $request->input("answer");
        $claim = new ClaimRepository();
        return response()->json(['satus'=>'success','data'=>$claim->update($status,$answer,$id)],200);
    }

    public function destroy($id)
    {
        $claim = new ClaimRepository();
        return response()->json(['success' => $claim->destroy($id),200]);
    }

    public function getMyClaims($id){
        $claim = new ClaimRepository();
        return response()->json(['success' => true,'data'=>$claim->getMyClaims($id)],200);
    }
}
