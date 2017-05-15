<?php

namespace App\Http\Controllers;

use App\Verification;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Visitor;
use App\Member;
use App\Appointment;
use \Carbon\Carbon;

class VisitorController extends Controller
{
    public function createVisitor(){
        $institutes = User::where('role','2')
            ->where('flag',1)
            ->get();
        return view('visitors.create-visitor-operator',compact('institutes'));
    }

    public function getMemberList($institute){
        $members = Member::where('building_id',Auth::user()->building_id)
            ->where('institute',$institute)
            ->get();
        return \Response::json($members);
    }

    public function getInstituteList(){

        return view('visitors.create-visitor-operator',compact('institutes'));
    }

    public function getVisitor($mobile){
        $visitors = Visitor::where('building_id',Auth::user()->building_id)
            ->where('flag',1)
            ->where('mobile',$mobile)
            ->get()
            ->first();
        return \Response::json($visitors);
    }


    /*sending sms*/

    private function httpGet($url, array $get = NULL, array $options = array()){



        $defaults = array(
            CURLOPT_URL => $url. (strpos($url, '?') === FALSE ? '?' : ''). http_build_query($get),
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 400,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false
        );
        $ch = curl_init();
        curl_setopt_array($ch, ($options + $defaults));
        $result = curl_exec($ch);

        if(curl_error($ch)) echo 'error:' . curl_error($ch);

        curl_close($ch);
        return $result;
    }


    private function SendSMSFuntion($to, $txt) {
        //--------------------------




        $api_key = 'YLoYt8H7kjMEf721AslWL8HHRBqkFgu00';
        $url="http://ezzeapps.com/sms";


        $data=array(
            'sender'=>"SmartAppointment",
            'receiver'=>$to,
            'text'=>$txt,
            'api_key'=>$api_key
        );

        $result=$this->httpGet($url,$data);



        return $result;

    }


    private function generateRandomString() {
        $length = 6;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function setVisitor(Request $request){

        //Generating Random Number
        $vcode =  $this->generateRandomString();






        //Sending SMS
        $msg = "Your Varification code is : ". $vcode." (Smart Appointment)";
        $val = $this->SendSMSFuntion($request->mobile,$msg);
        //return var_dump($val);
        //return $val;


        if($request->hasFile('image')){
            $image_url = $request->file('image')->store('avaters');;
        }else{
            $image_url = "/images/nota.jpg";
        }

        Visitor::updateOrCreate(['mobile' => $request->mobile,'building_id'=>Auth::user()->building_id],[
            'building_id' => Auth::user()->building_id,
            'mobile' => $request->mobile,
            'name' => $request->name,
            'profession' => $request->profession,
            'email' => $request->email,
            'address' => $request->address,
            'image_link' => $image_url,
            'flag' => 0,
        ]);

        $appointment = new Appointment;
        $appointment->building_id = Auth::user()->building_id;
        $appointment->institute   = $request->institute;
        $appointment->operator_id = Auth::user()->id;
        $appointment->visitor_id  = $request->mobile;
        $appointment->member_id   = $request->member;
        $appointment->reference   = $request->reference == "" ? "N/A" : $request->reference;
        $appointment->agendas     = $request->agenda == "" ? "N/A" : $request->agenda;
        $appointment->starts      = Carbon::parse($request->starts);
        $appointment->ends        = Carbon::parse($request->ends);
        $appointment->status      = "pending";
        $appointment->flag        = 0;

        $appointment->save();

        User::updateOrCreate(['email'=>$request->mobile],[
            'building_id'=> Auth::user()->building_id,
            'institute' => Auth::user()->institute,
            'name' => $request->name,
            'email' => $request->mobile,
            'role' => '5',
            'password' => bcrypt('visitor'),
            'flag' => 0,

        ]);


        $verify = new Verification();
        $verify->visitor_id = $request->mobile;
        $verify->vcode = $vcode;
        $verify->save();
        /*$user = new User;

        $user->building_id = Auth::user()->building_id;
        $user->institute = Auth::user()->institute;
        $user->name = $request->name;
        $user->email = $request->mobile;
        $user->role = "5";
        $user->password = bcrypt('visitor');
        $user->save();*/
        $mobile = $request->mobile;


        //return view('visitors.verification',compact('mobile'));
        return redirect('getVerify/'.$mobile);

    }

    public function visitorList(){
        $visitors = Visitor::where('flag',1)->get();
    }

}
