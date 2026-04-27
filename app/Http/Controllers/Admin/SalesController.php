<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{

    public function index(){

    // $key="today";

//     dd([
//     'start' => now()->subWeek()
// ]);

    $profit = DB::table('saleitems')
    ->join("sales", "sales.id", "saleitems.sale_id")
    ->selectRaw("SUM((saleitems.price - saleitems.bought_price) * saleitems.quantity) as profit")
    ->wheredate('sales.created_at', [
        now()->startOfWeek(),
        now()
    ])
    ->value('profit');

    dd($profit);
       
$profits = DB::table('saleitems')
    ->join('sales', 'saleitems.sale_id', '=', 'sales.id')
    ->join('products', 'saleitems.product_id', '=', 'products.id')
    ->selectRaw("DATE(sales.created_at) as sale_date, SUM((products.sold_price - products.bought_price) * saleitems.quantity) as total_profit")
    ->groupByRaw("DATE(sales.created_at)")
    ->orderBy("sale_date")
    ->get();


    return view("admin.sales", compact("profits"));

    }
//      public function getDaySales(Request $request){
// //         $date=$request->date;
// //         $day=date("d",strtotime($date));
// //   $date = $request->date; // e.g. "2025-09-29"


//     }

       


}
