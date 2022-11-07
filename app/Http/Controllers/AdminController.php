<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * This function show all products in admin panel
     */
    public function products() {
        return view('admin.products.products', ['products' => Product::latest()->get()]);
    }

    /**
     * This function show create products form
     */
    public function create() {
        return view('admin.products.create');
    }

    /**
     * This function store product in db
     */
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category' => 'required'
        ]);

        // convert category arr to str
        $formFields['category'] = implode(',', $request->category);

        if($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('products', 'public');
        } 

        Product::create($formFields);

        return redirect('/admin/products');
    }

    /**
     * This function delete product 
     */
    public function destroy(Product $product) {
        if($product->image) {
            unlink('storage/' . $product->image);
        }
        $product->delete();

        return back()->with('message', 'Product deleted');
    }

    /**
     * This function show edit product form
     */
    public function edit(Product $product) {
        return view('admin.products.edit', ['product' => $product]);
    }

    /**
     * This function update product in database
     */
    public function update(Request $request, Product $product) {
        $formFields = $request->validate([
            'title' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category' => 'required'
        ]);

        // convert category arr to str
        $formFields['category'] = implode(',', $request->category);

        // if product have image save that image
        $image = $product->image ?? '';
        // dd($image);
        // exit();
        $formFields['image'] = $image;

        if($request->hasFile('image')) {
            if($product->image) {
                unlink('storage/' . $product->image);
            }
            
            $formFields['image'] = $request->file('image')->store('products', 'public');
        } 
        
        // dd($formFields['image']);
        // exit();

        $product->update($formFields);

        return back()->with('message', 'Product updated');
    }

}
