<?php

use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;


Route::get("admin", function () {
    return view("admin.home");
})->name("admin");


Route::get("admin/sales/index", [SalesController::class, "index"])->name("admin.sales.index");
Route::get("admin/home", [HomeController::class, "index"])->name("admin.home");