<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Categorycontroller;
use App\Http\Controllers\Homecontroller;
use App\Http\Controllers\PaymentSupplierController;
use App\Http\Controllers\Productcontroller;
use App\Http\Controllers\Purchasecontroller;
use App\Http\Controllers\Salescontroller;
use App\Http\Controllers\Suppliercontroller;
use Illuminate\Support\Facades\Route;

    //  home 
Route::middleware("auth")->middleware("auth")->get('home', [Homecontroller::class, "index"])->name("home.index");
Route::get("/",function (){
     return view("employee.auth.login");
});

Route::controller(AuthController::class)->group(function () {
    Route::middleware("guest")->group(function () {
        Route::post("login", "login")->name("employee.login");
        Route::get("login/show", "show_login")->name("employee.show.login");
        Route::post("register", "register")->name("employee.register");
        Route::get("register/show", "show_register")->name("employee.show.register");
    });
    
    Route::middleware("auth")->delete("logout", "logout")->name("employee.logout");
});


     // categories
Route::middleware("auth")->get("categories", [Categorycontroller::class, "index"])->name("category.index");
Route::middleware("auth")->post("categories/add", [Categorycontroller::class, "store"])->name("category.add");
Route::middleware("auth")->put("categories/update", [Categorycontroller::class, "update"])->name("category.update");
Route::middleware("auth")->delete("categories/delete/{category}", [Categorycontroller::class, "destroy"])->name("category.delete");

      // products
Route::middleware("auth")->get("product", [Productcontroller::class, "index"])->name("product.index");
Route::middleware("auth")->post("product/add", [Productcontroller::class, "store"])->name("product.add");

Route::middleware("auth")->post("product/addPercentage", [Productcontroller::class, "addPercentage"])->name("product.addPercentage");
Route::middleware("auth")->delete("product/delete/{id}", [Productcontroller::class, "destroy"])->name("product.delete");
Route::middleware("auth")->patch("product/update/{id}", [Productcontroller::class, "update"])->name("product.update");


      // sales   
Route::middleware("auth")->get("sale/create", [Salescontroller::class, "create"])->name("sales.create");
Route::middleware("auth")->get("sale/index", [Salescontroller::class, "index"])->name("sales.index");
Route::middleware("auth")->post("sales/store", [Salescontroller::class, "store"])->name("sales.store");
Route::middleware("auth")->get("sale/sale-items/{id}", [Salescontroller::class, "showSaleItems"])->name("sales.items");
Route::middleware("auth")->post("sales/{id}/pay-partial", [Salescontroller::class, "payPartial"])->name("sales.payPartial");


    // purchases
Route::middleware("auth")->get("purchase/create", [Purchasecontroller::class, "create"])->name("purchase.create");
Route::middleware("auth")->get("purchase/show/{id}", [Purchasecontroller::class, "show"])->name("purchase.show");
Route::middleware("auth")->post("purchase/store", [Purchasecontroller::class, "store"])->name("purchase.store");
Route::middleware("auth")->get("purchase/index", [Purchasecontroller::class, "index"])->name("purchase.index");

    //suppliers
Route::middleware("auth")->get("supplier/index", [Suppliercontroller::class, "index"])->name("supplier.index");
Route::middleware("auth")->get("supplier/show/{id}", [Suppliercontroller::class, "show"])->name("supplier.show");
Route::middleware("auth")->post("supplier/store", [Suppliercontroller::class, "store"])->name("supplier.store");

    //payment supplier
Route::middleware("auth")->post("payment/store", [PaymentSupplierController::class, "store"])->name("payment.store");


       // admin routes
require "admin.php";