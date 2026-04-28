<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\SupplierPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Payment_Supplier_controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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


         $supplier_id=$request->supplier_id;
        $value=$request->value;

         $purchases=Purchase::where("supplier_id",$supplier_id)->where("remaining_amount",">","0")->orderBy("date","asc")->get();

         foreach($purchases as $purchase){
            if($value<=0) break;

            $apply=min($value,$purchase->remaining_amount);

            SupplierPayment::create([
                "supplier_id"=>$supplier_id,
                "purchase_id"=>$purchase->id,
                "paid"=>$apply,
                "date"=>now()
            ]);

            $value-=$apply;
            $purchase->remaining_amount-=$apply;
            $purchase->paid_amount+=$apply;
            $purchase->save();
            


         }
        
        return redirect()->back()->with('success', 'تم سداد الدفعة بنجاح');
    }

    
    public function show(string $id)
    {
        //
    }

    
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
