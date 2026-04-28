<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{

    public function index(Request $request){
        $query = DB::table('saleitems')
            ->join('sales', 'saleitems.sale_id', '=', 'sales.id')
            ->join('products', 'saleitems.product_id', '=', 'products.id')
            ->selectRaw("DATE(sales.created_at) as sale_date, SUM((saleitems.price - saleitems.bought_price) * saleitems.quantity) as total_profit");

        if ($request->has('date') && !empty($request->date)) {
            $query->whereDate('sales.created_at', $request->date);
        }

        if ($request->has('period')) {
            $now = now();
            if ($request->period == 'today') {
                $query->whereDate('sales.created_at', today());
            } elseif ($request->period == 'last_week') {
                $query->whereBetween('sales.created_at', [$now->copy()->subWeek()->startOfDay(), $now->copy()->endOfDay()]);
            } elseif ($request->period == 'last_month') {
                $query->whereBetween('sales.created_at', [$now->copy()->subMonth()->startOfDay(), $now->copy()->endOfDay()]);
            }
        }

        $profits = $query->groupByRaw("DATE(sales.created_at)")
            ->orderBy("sale_date")
            ->paginate(5);

        // Append query to pagination links
        $profits->appends($request->all());

        return view("admin.sales", compact("profits"));
    }

 


}
