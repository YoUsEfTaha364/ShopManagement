<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function check(){


        return view("admin.auth.check");
    }
        
    
    public function login(Request $request){
        if($request->password==1911){
            session(["auth_key"=>now()->addHour()]);
             return redirect()->route("admin.home");

        }

        return redirect()->back()->with("unauth_admin","انت غير مصرح بالدخول");
    }


}
