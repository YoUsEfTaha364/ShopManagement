<?php

use App\Http\Controllers\Admin\SalesController;
use Illuminate\Support\Facades\Route;


Route::get("admin", function () {
    return view("admin.home");
})->name("admin");


Route::get("admin/sales/index", [SalesController::class, "index"])->name("admin.sales.index");