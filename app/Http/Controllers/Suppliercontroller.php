<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Suppliercontroller extends Controller
{
   
    public function index()
    {
       $suppliers=Supplier::all();
$results = DB::table('suppliers')
    ->join("purchases", 'suppliers.id', '=', 'purchases.supplier_id')
    ->select(
        'suppliers.id as supplier_id',
        'suppliers.name',
        DB::raw('SUM(total_amount) as total'),
        DB::raw('SUM(paid_amount) as paid'),
        DB::raw('SUM(remaining_amount) as remaining')
    )
    ->groupBy('suppliers.id', 'suppliers.name')
    ->get();


       
     

       return view("admin.suppliers.index",["suppliers"=>$suppliers,"depts"=>$results]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $supplier=Supplier::create([
            "name"=>$request->supplier_name,
            "phone"=>$request->supplier_phone
         ]);


         return redirect()->route("purchase.create");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
  
}
