<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseIndexRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use Illuminate\Http\Request;

class Purchasecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PurchaseIndexRequest $request, \App\Services\PurchaseService $purchaseService)
    {
        $filters = $request->validated();
        $purchases = $purchaseService->getPurchases($filters, 5);
        return view('employee.purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        $categories = Category::all();
        return view("employee.purchases.create", compact("products", "suppliers", "categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $purchase = Purchase::create([
            "supplier_id" => $request->supplier_id,
            "total_amount" => $request->total,
            "paid_amount" => $request->paid,
            "remaining_amount" => $request->remaining,
            "date" => now()
        ]);

        $purchase_id = $purchase->id;

        $items = $request->items;

        for ($i = 0; $i < count($items); $i++) {
            $product_id = $items[$i]["product_id"];
            PurchaseItem::create([
                "product_id" => $items[$i]["product_id"],
                "price" => $items[$i]["price"],
                "quantity" => $items[$i]["quantity"],
                "subtotal" => $items[$i]["subtotal"],
                "purchase_id" => $purchase_id
            ]);

            $product = Product::find($product_id);
            $current_quantity = $product->quantity;
            
            $new_quantity = $current_quantity + $items[$i]["quantity"];
            Product::where("id", $product_id)->update([
                "bought_price" => $items[$i]["price"],
               
                "quantity" => $new_quantity
            ]);
        }

        return redirect()->route("purchase.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchase = Purchase::with("supplier")->findOrFail($id);
        $items = $purchase->items()->with("product")->paginate(5);
        return view("employee.purchases.show", compact("purchase", "items"));
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
