<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Salescontroller extends Controller
{

    public function index()
    {
        // $items=SaleItem::with("sale")->get();
        $sales = Sale::with("items")->get();
        $items = SaleItem::with("product")->get();

        return view("employee.sales.index", compact("sales", "items"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $products = Product::with('category')->get();
        $categories = Category::all();

        return view("employee.sales.create", compact("products", "categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //insert sale data




        try {
            DB::transaction(function () use ($request) {
                $sale = Sale::create([
                    "customer_name" => $request->customer_name,
                    "customer_phone" => $request->customer_phone,
                    "total_price" => $request->total,
                    "paid_price" => $request->paid,
                    "remaining_price" => $request->remaining,
                    "discount" => $request->discount ?? 0,
                ]);

                $items = $request->items;




                $sale_id = $sale->id;

                for ($i = 0; $i < count($items); $i++) {
                    $product = Product::find($items[$i]["product_id"]);

                    SaleItem::create([
                        "sale_id" => $sale_id,
                        "product_id" => $items[$i]["product_id"],
                        "quantity" => $items[$i]["quantity"],
                        "price" => $items[$i]["price"],
                        "bought_price" => $product->bought_price,
                        "subtotal" => $items[$i]["subtotal"],
                    ]);
                    $current_quantity = $product->quantity;

                    $new_quantity = $current_quantity - $items[$i]["quantity"];

                    if ($new_quantity < 0) {

                        throw new \Exception("Not enough stock for product ID: " . $product->id);
                    }

                    $product->update([

                        "quantity" => $new_quantity
                    ]);
                }
            });


            return redirect()->route('sales.index')
                ->with('success', 'Sale completed successfully!');
        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', $e->getMessage());
        }
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




    public function showSaleItems($id)
    {
        $sale = Sale::findOrFail($id);
        $items = SaleItem::where("sale_id", $id)->get();

        return view("employee.sales.show-saleitems", compact("items", "sale"));
    }

    public function payPartial(Request $request, $id)
    {

        $request->validate([
            'amount' => 'required|numeric|min:0'
        ]);

        $sale = Sale::findOrFail($id);

        if ($request->amount > $sale->remaining_price) {
            return redirect()->back()->with('error', 'المبلغ المدفوع يجب ألا يتجاوز المبلغ المتبقي.');
        }

        try {
            DB::transaction(function () use ($sale, $request) {
                SalePayment::create([
                    'sale_id' => $sale->id,
                    'amount' => $request->amount,
                ]);

                $sale->update([
                    'paid_price' => $sale->paid_price + $request->amount,
                    'remaining_price' => $sale->remaining_price - $request->amount,
                ]);
            });

            return redirect()->back()->with('success', 'تم تسجيل الدفعة بنجاح!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage());
        }
    }
}
