<?php

namespace App\Http\Controllers;

use App\Models\ContactModel;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    function ContactAdd(Request $request){
        date_default_timezone_set("Asia/Dhaka");
        $user_mobile=$request->input('user_mobile');
        $contact_type=$request->input('contact_type');
        $name=$request->input('name');
        $mobile_no=$request->input('mobile_no');
        $email=$request->input('email');
        $address_line_one=$request->input('address_line_one');
        $city=$request->input('city');
        $country=$request->input('country');
        $created_date= date("d-m-Y");
        $created_time= date("h:i:sa");
        $created_by=$request->input('created_by');

        $result= ContactModel::insert([
            'user_mobile'=>$user_mobile,
            'contact_type'=>$contact_type,
            'name'=>$name,
            'mobile_no'=>$mobile_no,
            'email'=>$email,
            'address_line_one'=>$address_line_one,
            'city'=>$city,
            'country'=>$country,
            'created_date'=>$created_date,
            'created_time'=>$created_time,
            'created_by'=>$created_by
        ]);
        return $result;
    }

    function ContactList(Request $request){
        $user_mobile=$request->input('user_mobile');
        $result= ContactModel::where('user_mobile',$user_mobile)->get();
        return $result;
    }

    function ContactDetails(Request $request){
        $id=$request->input('id');
        $result= ContactModel::where('id',$id)->get();
        return $result;
    }

    function ContactUpdate(Request $request){
        date_default_timezone_set("Asia/Dhaka");

        $id=$request->input('id');
        $contact_type=$request->input('contact_type');
        $name=$request->input('name');
        $mobile_no=$request->input('mobile_no');
        $email=$request->input('email');
        $web_site=$request->input('web_site');
        $address_line_one=$request->input('address_line_one');
        $city=$request->input('city');
        $country=$request->input('country');
        $created_date= date("d-m-Y");
        $created_time= date("h:i:sa");
        $updated_by=$request->input('updated_by');

        $result= ContactModel::where('id',$id)->update([
            'contact_type'=>$contact_type,
            'name'=>$name,
            'mobile_no'=>$mobile_no,
            'email'=>$email,
            'address_line_one'=>$address_line_one,
            'city'=>$city,
            'country'=>$country,
            'updated_date'=>$created_date,
            'updated_time'=>$created_time,
            'updated_by'=>$updated_by
        ]);
        return $result;
    }

    function ContactDelete(Request $request){
        $id=$request->input('id');
        $result=ContactModel::where('id','=',$id)->delete();
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }
    
   function ContactFilter(Request $request){
        $user_mobile=$request->input('user_mobile');
        $customer=$request->input('customer');
        $delivery_partner=$request->input('delivery_partner');
        $supplier=$request->input('supplier');
        $result1= ContactModel::where('user_mobile', '=',$user_mobile)->where('contact_type', '=', $supplier)->get();
        $result2= ContactModel::where('user_mobile', '=',$user_mobile)->where('contact_type', '=', $delivery_partner)->get();
        $result3= ContactModel::where('user_mobile', '=',$user_mobile)->where('contact_type', '=', $customer)->get();
        $result = $result1->merge($result2)->merge($result3);
        return $result;
    }

    
}
