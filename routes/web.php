<?php

use App\Http\Controllers\Categorycontroller;
use App\Http\Controllers\Homecontroller;
use App\Http\Controllers\Payment_Supplier_controller;
use App\Http\Controllers\Productcontroller;
use App\Http\Controllers\Purchasecontroller;
use App\Http\Controllers\Salescontroller;
use App\Http\Controllers\Suppliercontroller;
use Illuminate\Support\Facades\Route;

    //  home 
Route::get('home', [Homecontroller::class, "index"])->name("home.index");
Route::get('/', [Homecontroller::class, "index"]);


     // categories
Route::get("categories", [Categorycontroller::class, "index"])->name("category.index");
Route::post("categories/add", [Categorycontroller::class, "store"])->name("category.add");
Route::put("categories/update", [Categorycontroller::class, "update"])->name("category.update");
Route::delete("categories/delete/{category}", [Categorycontroller::class, "destroy"])->name("category.delete");

      // products
Route::get("product", [Productcontroller::class, "index"])->name("product.index");
Route::post("product/add", [Productcontroller::class, "store"])->name("product.add");

Route::post("product/addPercentage", [Productcontroller::class, "addPercentage"])->name("product.addPercentage");
Route::delete("product/delete/{id}", [Productcontroller::class, "destroy"])->name("product.delete");
Route::patch("product/update/{id}", [Productcontroller::class, "update"])->name("product.update");


      // sales   
Route::get("sale/create", [Salescontroller::class, "create"])->name("sales.create");
Route::get("sale/index", [Salescontroller::class, "index"])->name("sales.index");
Route::post("sales/store", [Salescontroller::class, "store"])->name("sales.store");
Route::get("sale/sale-items/{id}", [Salescontroller::class, "showSaleItems"])->name("sales.items");
Route::post("sales/{id}/pay-partial", [Salescontroller::class, "payPartial"])->name("sales.payPartial");


    // purchases
Route::get("purchase/create", [Purchasecontroller::class, "create"])->name("purchase.create");
Route::get("purchase/show/{id}", [Purchasecontroller::class, "show"])->name("purchase.show");
Route::post("purchase/store", [Purchasecontroller::class, "store"])->name("purchase.store");
Route::get("purchase/index", [Purchasecontroller::class, "index"])->name("purchase.index");

    //suppliers
Route::get("supplier/index", [Suppliercontroller::class, "index"])->name("supplier.index");
Route::get("supplier/show/{id}", [Suppliercontroller::class, "show"])->name("supplier.show");
Route::post("supplier/store", [Suppliercontroller::class, "store"])->name("supplier.store");

    //payment supplier
Route::post("payment/store", [Payment_Supplier_controller::class, "store"])->name("payment.store");


       // admin routes
require "admin.php";