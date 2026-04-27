<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index(){
       

    return view("admin.home");

    }
//      public function getDaySales(Request $request){
// //         $date=$request->date;
// //         $day=date("d",strtotime($date));
// //   $date = $request->date; // e.g. "2025-09-29"


//     }

       


}
