<?php

namespace App\Http\Controllers;

        use Illuminate\Support\Facades\DB;
use App\Models\Sale;
use Illuminate\Http\Request;

class Homecontroller extends Controller
{
    public function index(){

    $revenue = DB::table('saleitems')
    ->selectRaw('SUM(quantity * price)')->value("revenue");

    $profit = DB::table('saleitems')
    ->selectRaw('SUM(saleitems.quantity * (saleitems.price - saleitems.bought_price))')
    ->value('profit');


        return view("employee.home",compact("profit","revenue"));
    }



   
}
