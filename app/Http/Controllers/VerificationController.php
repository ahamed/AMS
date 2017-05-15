<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;
use App\Visitor;
use App\Verification;
use App\User;
use Auth;
use \Session;



class VerificationController extends Controller
{







    public function getVerify($mobile){
        return view('visitors.verification',compact('mobile'));
    }

    public function verify(Request $request){
        $verification = Verification::where('visitor_id',$request->mobile)->get()->first();
        //return sizeof($verification);

        if(sizeof($verification) > 0){
            if($request->vcode == $verification->vcode){
                $user = User:: where('email',$request->mobile)->get()->first();
                $user->flag = 1;
                $user->save();

                $visitor = Visitor::where('mobile',$request->mobile)->get()->first();
                $visitor->flag = 1;
                $visitor->save();

                $appointment = Appointment::where('visitor_id',$request->mobile)->get()->first();
                $appointment->flag = 1;
                $appointment->save();

                $verification->delete();
                return redirect('/');
            }else{
                $mobile = $request->mobile;
                //return "Not Matched";
                Session::put('errMsg','The Code does not match! Please Try again');
                return redirect('/getVerify/'.$mobile);
            }
        }
    }
}
