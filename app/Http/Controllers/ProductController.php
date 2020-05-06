<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();

        return view('products.index', [
            'product' => $products
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', [
            'category' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->value = $request->value;
        $product->id_category = $request->category;
        $product->save();

        return redirect()->route('product.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', [
            'product' => $product,
            'category' => $categories
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $product->name = $request->name;
        $product->description = $request->description;
        $product->value = $request->value;
        $product->id_category = $request->category;
        $product->save();

        return redirect()->route('product.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index');
    }

    public function autocomplete(Request $request){
        if($request->ajax()) {
            $products = Product::where('name', 'LIKE', '%'.$request->product.'%')->get();
            if (count($products)>0) {
                foreach ($products as $product){
                    $output .= $product->name.';'.$product->id. '/';
                }
            }
            else {
                return;
            }
            return $output;
        } 
    }
}
