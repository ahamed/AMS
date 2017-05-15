<?php

namespace App\Http\Controllers;
use App\Appointment;
use App\User;
use Auth;
use \Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == '2'){
            $data = Appointment::where('appointments.building_id',Auth::user()->building_id)
                ->where('appointments.institute','=',Auth::user()->institute)
                ->where('appointments.status','=','pending')
                ->orderBy('appointments.starts','ASC')
                ->join('visitors','visitors.mobile','=','appointments.visitor_id')
                ->join('members','members.mobile','=','appointments.member_id')
                ->select('visitors.name','members.name as memname','visitors.address','appointments.*')
                ->where('appointments.flag','=',1)
                ->get();


        }else if(Auth::user()->role == '3'){
            $data = Appointment::where('appointments.building_id',Auth::user()->building_id)
                ->where('appointments.status','=','pending')
                ->orderBy('appointments.starts','ASC')
                ->join('visitors','visitors.mobile','=','appointments.visitor_id')
                ->join('members','members.mobile','=','appointments.member_id')
                ->select('visitors.name','members.name as memname','visitors.address','appointments.*')
                ->where('appointments.flag','=',1)
                ->get();
        }else if(Auth::user()->role == '4'){
            $data = Appointment::where('appointments.member_id',Auth::user()->email)
                ->where('appointments.status','=','pending')
                ->orderBy('appointments.starts','ASC')
                ->join('visitors','visitors.mobile','=','appointments.visitor_id')
                ->join('members','members.mobile','=','appointments.member_id')
                ->select('visitors.name','members.name as memname','visitors.address','appointments.*')
                ->where('appointments.flag','=',1)
                ->get();
        }else{
            $data = [];
        }
        return view('home',compact('data'));
    }


}
