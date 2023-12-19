<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at')->get();

        return view('products.index',[
            'products' => $products
        ]);
    }
    public function create()
    {
        return view('products.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:191',
            'type' => 'required|max:191',
            'price' => 'required|integer'
        ]);

        Product::create($request->all());

        return to_route('product.index');
    }

    public function edit(string $id)
    {
        $product = Product::find($id);
        return view('products.edit',[
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:191',
            'type' => 'required|max:191',
            'price' => 'required|integer'
        ]);

        Product::find($id)->update($request->all());

        return to_route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::find($id)->delete();

        return back();
    }
}
