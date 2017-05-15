<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use Auth;
use Illuminate\Http\Response;

use App\User;



class MemberController extends Controller
{
    public function createMember(){
        return view('members.create');
    }
    public function setMember(Request $request){

        $image_destination = "/images/nota.jpg";
        if($request->hasFile('image_url')){

            $image_destination = $request->file('image_link')->store('avaters');

        }

        //return Auth::user()->institute;

        Member::updateOrCreate(["mobile" => $request->mobile],[
            "building_id" => Auth::user()->building_id,
            "name" => $request->name,
            "designation" => $request->designation,
            "email" => $request->email,
            "address" => $request->address,
            "institute" => Auth::user()->institute,
            "image_link" => $image_destination,
            "mobile" => $request->mobile,


        ]);

        $user = new User;

        $user->building_id = Auth::user()->building_id;
        $user->institute = Auth::user()->institute;
        $user->name = $request->name;
        $user->email = $request->mobile;
        $user->role = "4";
        $user->password = bcrypt('member');
        $user->flag = 1;
        $user->save();

        return redirect()->back();

    }

    public function getMember($id){
        $members = Member::where('mobile',$id)
            ->get()->first();
        return \Response::json($members);
    }

    public function memberList(){
        $members = Member::all();
        return view('members.member-list',compact('members'));
    }
}
