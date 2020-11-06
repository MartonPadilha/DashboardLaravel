<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Product;
use App\UM;

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
        $um = UM::all();
        return view('products.create', [
            'category' => $categories,
            'um' => $um
        ]);
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->value = $request->value;
        $product->cost = $request->cost;
        $product->id_category = $request->category;
        $product->quantity = $request->quantity;
        $product->id_um = $request->um;
        $product->save();

        return redirect()->route('product.index')->with('create', 'Produto '. $product->name .' criado!');
    }

    public function show($id)
    {
        //
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $um = UM::all();
        return view('products.edit', [
            'product' => $product,
            'category' => $categories,
            'um' => $um
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $product->name = $request->name;
        $product->description = $request->description;
        $product->value = $request->value;
        $product->cost = $request->cost;
        $product->id_category = $request->category;
        $product->quantity = $request->quantity;
        $product->id_um = $request->um;
        $product->save();

        return redirect()->route('product.index')->with('edit', 'Produto '. $product->name .' editado!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('delete', 'Produto '. $product->name .' deletado!');
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
