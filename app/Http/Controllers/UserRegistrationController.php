<?php

namespace App\Http\Controllers;
use App\Models\OtpModel;
use App\Models\UserRegistrationModel;
use Illuminate\Http\Request;



class UserRegistrationController extends Controller
{

    function CreateOTP(Request $request){
        date_default_timezone_set("Asia/Dhaka");
        $mobile=$request->input('mobile');
        $digit_random_number = mt_rand(1000, 9999);
        $smsBody="হিসাব বন্ধুর প্রিয় গ্রাহক আপন ৪ সংখ্যার ভেরিফিকেশন পিন ". $digit_random_number;
        $created_timestamp=time();
        $created_time= date("h:i:sa");
        $created_date= date("d-m-Y");
        $check=UserRegistrationModel::where('mobile',$mobile)->count();
        if ($check>0){
            return "exist";
        }
        else{
        $sendSMS= SMSClass::CreateSMS( $mobile,$smsBody);
        $result= OtpModel::insert([
                'mobile'=>$mobile,
                'otp'=>$digit_random_number,
                'created_timestamp'=>$created_timestamp,
                'created_date'=>$created_date,
                'created_time'=>$created_time,
            ]);
        return $result;
        }
        
    }
    
    
    function OtpVerification(Request $request){
        $otp=$request->input('otp');
        $mobile=$request->input('mobile');
        $countNo= OtpModel::Where('mobile',$mobile)->Where('otp',$otp)->count();
        if($countNo>0){
            return 1;
        }
        else{
            return 0;
        }
    }
    

    function UserRegistration(Request $request){
        date_default_timezone_set("Asia/Dhaka");
        $mobile=$request->input('mobile');
        $user_full_name=$request->input('user_full_name');
        $business_name=$request->input('business_name');
        $password=$request->input('password');
        $created_date=date("d-m-Y");
        $created_time=date("h:i:sa");
        $check=UserRegistrationModel::where('mobile',$mobile)->count();
        if ($check>0){
            return "exist";
        }
        else{
            $result=UserRegistrationModel::insert([
                'mobile'=>$mobile,
                'user_full_name'=>$user_full_name,
                'business_name'=>$business_name,
                'password'=>$password,
                'created_date'=>$created_date,
                'created_time'=>$created_time
            ]);
            return $result;
        }
    }



    function UserLogin(Request $request){
        $mobile=$request->input('mobile');
        $password=$request->input('password');
        $userCount=UserRegistrationModel::where('mobile',$mobile)->where('password',$password)->count();
        if ($userCount==1){
            $result= UserRegistrationModel::where('mobile',$mobile)->where('password',$password)->get();
            return $result;
        }
        else{
            return 0;
        }
    }
    
    
    function CheckUser(Request $request){
        $mobile=$request->input('mobile');
        $userCount=UserRegistrationModel::where('mobile',$mobile)->count();
        if ($userCount==1){
        date_default_timezone_set("Asia/Dhaka");
        $mobile=$request->input('mobile');
        $digit_random_number = mt_rand(1000, 9999);
        $smsBody="হিসাব বন্ধুর প্রিয় গ্রাহক আপন ৪ সংখ্যার ভেরিফিকেশন পিন ". $digit_random_number;
        $created_timestamp=time();
        $created_time= date("h:i:sa");
        $created_date= date("d-m-Y");
            
        $sendSMS= SMSClass::CreateSMS( $mobile,$smsBody);
        $result= OtpModel::insert([
                'mobile'=>$mobile,
                'otp'=>$digit_random_number,
                'created_timestamp'=>$created_timestamp,
                'created_date'=>$created_date,
                'created_time'=>$created_time,
            ]);
        return $result;
        }
        else{
            return "not_exist";
        }
    }
    

   function UpdatePassword(Request $request){
        $mobile=$request->input('mobile');
        $password=$request->input('password');
        $result=UserRegistrationModel::where('mobile',$mobile)->update(['password'=>$password]);
        return $result;
    }
    

}
