<?php

namespace App\Http\Controllers;

use App\Models\ContactModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function HomeCounting(Request $request){
        $user_mobile=$request->input('user_mobile');
        $Contact= ContactModel::where('user_mobile',$user_mobile)->get()->count();
        $Product= ProductModel::where('user_mobile',$user_mobile)->get()->count();
    
        return(
            array(
                'TotalContact'=>$Contact,
                'TotalProduct'=>$Product,
                )
        );
    }


}
