<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use App\User;
use App\Visitor;
use App\Member;
use Auth;
use Response;
use Carbon\Carbon;

class AppointmentController extends Controller
{

    public function getVisitorList(){
        $visitors = Visitor::where('building_id',Auth::user()->building_id)
            ->where('flag',1)
            ->get();
        return view('appointment.visitors',compact('visitors'));
    }

    public function deoInstituteList(){
        $institutes = User::where('role','2')
            ->where('flag',1)
            ->get();
        return view('appointment.member-list',compact('institutes'));
    }

    public function deoMemberList($institute){
        $members = Member::where('institute',$institute)->get();
        return Response::json($members);
    }

    /*Get Reports page*/
    public function deoReportsView(){
        return View('appointment.reports');
    }

    public function adminReportsView(){
        return View('appointment.admin-report');
    }

    public function appointeeReportsView(){
        return View('appointment.appointee-report');
    }

    public function deoReport($type, $data, $status){

        if($data == "today"){
            $data = Carbon::now()->day;
        }

        if($type == "daily"){
            /*$reportData = Appointment::whereDay('created_at','=',Carbon::now()->day)
                ->where('building_id',Auth::user()->building_id)
                ->get();*/
            if($status != "all"){
                $reportData = Appointment::whereDay('appointments.created_at','=',$data)
                    ->where('appointments.building_id',Auth::user()->building_id)
                    ->where('appointments.status',$status)
                    ->join('visitors','visitors.mobile','=','appointments.visitor_id')
                    ->join('members','members.mobile','=','appointments.member_id')
                    ->select('visitors.name as visitor_name','members.name','visitors.address','appointments.*')
                    ->orderBy('appointments.created_at','DESC')
                    ->where('appointments.flag','=',1)
                    ->get();
            }else{
                $reportData = Appointment::whereDay('appointments.created_at','=',$data)
                    ->where('appointments.building_id',Auth::user()->building_id)
                    ->join('visitors','visitors.mobile','=','appointments.visitor_id')
                    ->join('members','members.mobile','=','appointments.member_id')
                    ->select('visitors.name as visitor_name','members.name','visitors.address','appointments.*')
                    ->orderBy('appointments.created_at','DESC')
                    ->where('appointments.flag','=',1)
                    ->get();
            }


        }else if($type == "monthly"){


            if($status != "all"){
                $reportData = Appointment::whereMonth('appointments.created_at','=',$data)
                    ->where('appointments.building_id',Auth::user()->building_id)
                    ->where('appointments.status',$status)
                    ->join('visitors','visitors.mobile','=','appointments.visitor_id')
                    ->join('members','members.mobile','=','appointments.member_id')
                    ->select('visitors.name as visitor_name','members.name','visitors.address','appointments.*')
                    ->orderBy('appointments.created_at','DESC')
                    ->where('appointments.flag','=',1)
                    ->get();
            }else{
                $reportData = Appointment::whereMonth('appointments.created_at','=',$data)
                    ->where('appointments.building_id',Auth::user()->building_id)
                    ->join('visitors','visitors.mobile','=','appointments.visitor_id')
                    ->join('members','members.mobile','=','appointments.member_id')
                    ->select('visitors.name as visitor_name','members.name','visitors.address','appointments.*')
                    ->orderBy('appointments.created_at','DESC')
                    ->where('appointments.flag','=',1)
                    ->get();
            }

        }else if($type == "yearly"){

            if($status != "all"){
                $reportData = Appointment::whereYear('appointments.created_at','=',$data)
                    ->where('appointments.building_id',Auth::user()->building_id)
                    ->where('appointments.status',$status)
                    ->join('visitors','visitors.mobile','=','appointments.visitor_id')
                    ->join('members','members.mobile','=','appointments.member_id')
                    ->select('visitors.name as visitor_name','members.name','visitors.address','appointments.*')
                    ->orderBy('appointments.created_at','DESC')
                    ->where('appointments.flag','=',1)
                    ->get();
            }else{
                $reportData = Appointment::whereYear('appointments.created_at','=',$data)
                    ->where('appointments.building_id',Auth::user()->building_id)
                    ->join('visitors','visitors.mobile','=','appointments.visitor_id')
                    ->join('members','members.mobile','=','appointments.member_id')
                    ->select('visitors.name as visitor_name','members.name','visitors.address','appointments.*')
                    ->orderBy('appointments.created_at','DESC')
                    ->where('appointments.flag','=',1)
                    ->get();
            }

        }



        return Response::json($reportData);
    }


    /*admin report*/


    public function adminReport($type, $data, $status){

        if($data == "today"){
            $data = Carbon::now()->day;
        }

        if($type == "daily"){
            /*$reportData = Appointment::whereDay('created_at','=',Carbon::now()->day)
                ->where('building_id',Auth::user()->building_id)
                ->get();*/
            if($status != "all"){
                $reportData = Appointment::whereDay('appointments.created_at','=',$data)
                    ->where('appointments.building_id',Auth::user()->building_id)
                    ->where('appointments.institute','=',Auth::user()->institute)
                    ->where('appointments.status',$status)
                    ->join('visitors','visitors.mobile','=','appointments.visitor_id')
                    ->join('members','members.mobile','=','appointments.member_id')
                    ->select('visitors.name as visitor_name','members.name','visitors.address','appointments.*')
                    ->orderBy('appointments.created_at','DESC')
                    ->where('appointments.flag','=',1)
                    ->get();
            }else{
                $reportData = Appointment::whereDay('appointments.created_at','=',$data)
                    ->where('appointments.building_id',Auth::user()->building_id)
                    ->where('appointments.institute','=',Auth::user()->institute)
                    ->join('visitors','visitors.mobile','=','appointments.visitor_id')
                    ->join('members','members.mobile','=','appointments.member_id')
                    ->select('visitors.name as visitor_name','members.name','visitors.address','appointments.*')
                    ->orderBy('appointments.created_at','DESC')
                    ->where('appointments.flag','=',1)
                    ->get();
            }


        }else if($type == "monthly"){


            if($status != "all"){
                $reportData = Appointment::whereMonth('appointments.created_at','=',$data)
                    ->where('appointments.building_id',Auth::user()->building_id)
                    ->where('appointments.institute','=',Auth::user()->institute)
                    ->where('appointments.status',$status)
                    ->join('visitors','visitors.mobile','=','appointments.visitor_id')
                    ->join('members','members.mobile','=','appointments.member_id')
                    ->select('visitors.name as visitor_name','members.name','visitors.address','appointments.*')
                    ->orderBy('appointments.created_at','DESC')
                    ->where('appointments.flag','=',1)
                    ->get();
            }else{
                $reportData = Appointment::whereMonth('appointments.created_at','=',$data)
                    ->where('appointments.building_id',Auth::user()->building_id)
                    ->where('appointments.institute','=',Auth::user()->institute)
                    ->join('visitors','visitors.mobile','=','appointments.visitor_id')
                    ->join('members','members.mobile','=','appointments.member_id')
                    ->select('visitors.name as visitor_name','members.name','visitors.address','appointments.*')
                    ->orderBy('appointments.created_at','DESC')
                    ->where('appointments.flag','=',1)
                    ->get();
            }

        }else if($type == "yearly"){

            if($status != "all"){
                $reportData = Appointment::whereYear('appointments.created_at','=',$data)
                    ->where('appointments.building_id',Auth::user()->building_id)
                    ->where('appointments.institute','=',Auth::user()->institute)
                    ->where('appointments.status',$status)
                    ->join('visitors','visitors.mobile','=','appointments.visitor_id')
                    ->join('members','members.mobile','=','appointments.member_id')
                    ->select('visitors.name as visitor_name','members.name','visitors.address','appointments.*')
                    ->orderBy('appointments.created_at','DESC')
                    ->where('appointments.flag','=',1)
                    ->get();
            }else{
                $reportData = Appointment::whereYear('appointments.created_at','=',$data)
                    ->where('appointments.building_id',Auth::user()->building_id)
                    ->where('appointments.institute','=',Auth::user()->institute)
                    ->join('visitors','visitors.mobile','=','appointments.visitor_id')
                    ->join('members','members.mobile','=','appointments.member_id')
                    ->select('visitors.name as visitor_name','members.name','visitors.address','appointments.*')
                    ->orderBy('appointments.created_at','DESC')
                    ->where('appointments.flag','=',1)
                    ->get();
            }

        }



        return Response::json($reportData);
    }

    public function appointeeReport($type, $data, $status){

        if($data == "today"){
            $data = Carbon::now()->day;
        }

        if($type == "daily"){
            /*$reportData = Appointment::whereDay('created_at','=',Carbon::now()->day)
                ->where('building_id',Auth::user()->building_id)
                ->get();*/
            if($status != "all"){
                $reportData = Appointment::whereDay('appointments.created_at','=',$data)
                    ->where('appointments.building_id',Auth::user()->building_id)
                    ->where('appointments.institute','=',Auth::user()->institute)
                    ->where('appointments.member_id','=',Auth::user()->email)
                    ->where('appointments.status',$status)
                    ->join('visitors','visitors.mobile','=','appointments.visitor_id')
                    ->join('members','members.mobile','=','appointments.member_id')
                    ->select('visitors.name as visitor_name','members.name','visitors.address','appointments.*')
                    ->orderBy('appointments.created_at','DESC')
                    ->where('appointments.flag','=',1)
                    ->get();
            }else{
                $reportData = Appointment::whereDay('appointments.created_at','=',$data)
                    ->where('appointments.building_id',Auth::user()->building_id)
                    ->where('appointments.institute','=',Auth::user()->institute)
                    ->where('appointments.member_id','=',Auth::user()->email)
                    ->join('visitors','visitors.mobile','=','appointments.visitor_id')
                    ->join('members','members.mobile','=','appointments.member_id')
                    ->select('visitors.name as visitor_name','members.name','visitors.address','appointments.*')
                    ->orderBy('appointments.created_at','DESC')
                    ->where('appointments.flag','=',1)
                    ->get();
            }


        }else if($type == "monthly"){


            if($status != "all"){
                $reportData = Appointment::whereMonth('appointments.created_at','=',$data)
                    ->where('appointments.building_id',Auth::user()->building_id)
                    ->where('appointments.institute','=',Auth::user()->institute)
                    ->where('appointments.member_id','=',Auth::user()->email)
                    ->where('appointments.status',$status)
                    ->join('visitors','visitors.mobile','=','appointments.visitor_id')
                    ->join('members','members.mobile','=','appointments.member_id')
                    ->select('visitors.name as visitor_name','members.name','visitors.address','appointments.*')
                    ->orderBy('appointments.created_at','DESC')
                    ->where('appointments.flag','=',1)
                    ->get();
            }else{
                $reportData = Appointment::whereMonth('appointments.created_at','=',$data)
                    ->where('appointments.building_id',Auth::user()->building_id)
                    ->where('appointments.institute','=',Auth::user()->institute)
                    ->where('appointments.member_id','=',Auth::user()->email)
                    ->join('visitors','visitors.mobile','=','appointments.visitor_id')
                    ->join('members','members.mobile','=','appointments.member_id')
                    ->select('visitors.name as visitor_name','members.name','visitors.address','appointments.*')
                    ->orderBy('appointments.created_at','DESC')
                    ->where('appointments.flag','=',1)
                    ->get();
            }

        }else if($type == "yearly"){

            if($status != "all"){
                $reportData = Appointment::whereYear('appointments.created_at','=',$data)
                    ->where('appointments.building_id',Auth::user()->building_id)
                    ->where('appointments.institute','=',Auth::user()->institute)
                    ->where('appointments.member_id','=',Auth::user()->email)
                    ->where('appointments.status',$status)
                    ->join('visitors','visitors.mobile','=','appointments.visitor_id')
                    ->join('members','members.mobile','=','appointments.member_id')
                    ->select('visitors.name as visitor_name','members.name','visitors.address','appointments.*')
                    ->orderBy('appointments.created_at','DESC')
                    ->where('appointments.flag','=',1)
                    ->get();
            }else{
                $reportData = Appointment::whereYear('appointments.created_at','=',$data)
                    ->where('appointments.building_id',Auth::user()->building_id)
                    ->where('appointments.institute','=',Auth::user()->institute)
                    ->where('appointments.member_id','=',Auth::user()->email)
                    ->join('visitors','visitors.mobile','=','appointments.visitor_id')
                    ->join('members','members.mobile','=','appointments.member_id')
                    ->select('visitors.name as visitor_name','members.name','visitors.address','appointments.*')
                    ->orderBy('appointments.created_at','DESC')
                    ->where('appointments.flag','=',1)
                    ->get();
            }

        }



        return Response::json($reportData);
    }


    public function setAccept($id){
        $appointment = Appointment::where('id',$id)->get()->first();
        $appointment->status = "accepted";
        $appointment->save();
        return redirect()->back();

    }

    public function setReject($id){
        $appointment = Appointment::where('id',$id)->get()->first();
        $appointment->status = "rejected";
        $appointment->save();

        return redirect()->back();

    }
}
