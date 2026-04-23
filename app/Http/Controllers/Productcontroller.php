<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Productcontroller extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           $products = Product::with('category')->get();
           $categories = Category::all();

           $count=Product::count();

        return view("employee.products", compact("count", "products", "categories"));
        
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
   
      
          if ( $request->redirect == 'purchase') {
            
             Product::create([
            "name"=>$request->name,
            "category_id"=>$request->category_id,
            "quantity"=>$request->count,
            "bought_price"=>$request->b_price,
            "sold_price"=>$request->s_price,
           ]);

        return redirect()->route('purchase.create')
                         ->with('success', 'Product added and ready for purchase');
    }else{
                $data = json_decode($request->category, true); 
         $categoryId = $data['id'];
                  Product::create([
            "name"=>$request->name,
            "category_id"=>$categoryId,
            "quantity"=>$request->count,
            "bought_price"=>$request->b_price,
            "sold_price"=>$request->s_price,
           ]);

            return redirect()->route('product.index')
                     ->with('success', 'Product created successfully');

    }

    }

        
  
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
        Product::find($id)->update([
            "name"=>$request->name,
            "sold_price"=>$request->price
        ]);


        return redirect()->route("product.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);


        return redirect()->route("product.index");



    }
    public function addPercentage(Request $request)
    {
        $value=$request->percentage / 100;

       DB::table('products')->update([
    'sold_price' => DB::raw(" sold_price +  (sold_price * $value)")
]);
   
    return redirect()->route("product.index");

         
    }
}
