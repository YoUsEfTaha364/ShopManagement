<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index(){

    $today_sales=Sale::whereDate("created_at",today())->sum("total_price");
    
    $today_profit= DB::table('saleitems')
        ->join('sales', 'sales.id', '=', 'saleitems.sale_id')
        ->whereDate("sales.created_at",today())
        ->sum(DB::raw('saleitems.quantity * (saleitems.price - saleitems.bought_price)'));

     $cash_i_have= Sale::sum("paid_price");
     $remaining=Sale::sum("remaining_price");

     $dept=Purchase::sum("remaining_amount");

    return view("admin.home", compact(
        'today_sales',
        'today_profit',
        'cash_i_have',
        'remaining',
        'dept'
    ));

    }
//      public function getDaySales(Request $request){
// //         $date=$request->date;
// //         $day=date("d",strtotime($date));
// //   $date = $request->date; // e.g. "2025-09-29"


//     }

       


}
