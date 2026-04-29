<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierIndexRequest;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Suppliercontroller extends Controller
{

    public function index(SupplierIndexRequest $request, \App\Services\SupplierService $supplierService)
    {
        $filters = $request->validated();
        $depts = $supplierService->getSuppliersDebts($filters, 10);
        $suppliers = Supplier::all(); // keeping this in case it's used somewhere in layout

        return view("admin.suppliers.index", ["suppliers" => $suppliers, "depts" => $depts]);
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
        $supplier = Supplier::create([
            "name" => $request->supplier_name,
            "phone" => $request->supplier_phone
        ]);


        return redirect()->route("purchase.create");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        
        $purchases = Purchase::with('items', 'items.product')->where('supplier_id', $id)->orderBy('date', 'desc')->get();
        
        $total = $purchases->sum('total_amount');
        $paid = $purchases->sum('paid_amount');
        $remaining = $purchases->sum('remaining_amount');

        return view('admin.suppliers.show', compact('supplier', 'purchases', 'total', 'paid', 'remaining'));
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
