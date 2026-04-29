<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;


Route::middleware("admin_auth")->get("admin", function () {
    return view("admin.home");
})->name("admin");

Route::middleware("auth")->get("admin/check",[AuthController::class,"check"])->name("admin.check");
Route::middleware("auth")->post("admin/login",[AuthController::class,"login"])->name("admin.login");


Route::middleware("admin_auth")->get("admin/sales/index", [SalesController::class, "index"])->name("admin.sales.index");
Route::middleware("admin_auth")->get("admin/home", [HomeController::class, "index"])->name("admin.home");