<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class Salescontroller extends Controller
{
    
    public function index()
    {
        // $items=SaleItem::with("sale")->get();
          $sales=Sale::with("items")->get();
          $items=SaleItem::with("product")->get();

        return view("employee.sales.index",compact("sales","items"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
           $products = Product::with('category')->get();
           $categories = Category::all();

           return view("employee.sales.create",compact("products","categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //insert sale data

        
       $sale= Sale::create([
            "customer_name"=>$request->customer_name,
            "customer_phone"=>$request->customer_phone,
            "total_price"=>$request->total,
            "paid_price"=>$request->paid,
            "remaining_price"=>$request->remaining
        ]);
        $sale_id=$sale->id;
             $items=$request->items;
          for($i=0;$i<count($items);$i++){
                  SaleItem::create([
                     "sale_id"=>$sale_id,
                     "product_id"=>$items[$i]["product_id"],
                     "quantity"=>$items[$i]["quantity"],
                     "price"=>$items[$i]["price"],
                     "subtotal"=>$items[$i]["subtotal"],
                  ]);
                   $product=Product::find($items[$i]["product_id"]);
    $current_quantity=$product->quantity;
    $new_quantity=$current_quantity - $items[$i]["quantity"];
              Product::where("id",$items[$i]["product_id"])->update([
                    
                    "quantity"=>$new_quantity
              ]);
          }
       
              
              return redirect()->route('sales.index')->with('success', 'Product added successfully!');
            
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
       $items= SaleItem::where("sale_id",$id)->get();
        
        

        return view("employee.sales.show-saleitems",compact("items"));
    }

}
