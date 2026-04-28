<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class Categorycontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::paginate(5);
        $count=Category::count();
        
        return view("employee.categories", compact('categories', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            "name"=>"required|string"
        ]);

        Category::create([
            "name"=>$validated["name"]
        ]);

        return redirect()->route('category.index')->with('success', 'Product added successfully!');
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
    public function update(Request $request)
    {
       
          $validated=$request->validate([
            "name"=>"required|string"
        ]);


        $id=$request->id;
        Category::find($id)->update([
            "name"=>$validated["name"],
        ]);

          return redirect()->route("category.index");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::destroy($id);


        return redirect()->route("category.index");
    }
}
