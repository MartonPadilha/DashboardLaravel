<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $category = new Category();

        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        
        return redirect()->route('category.index')->withStatus("Categoria criada com sucesso!");
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('categories.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return redirect()->route('category.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        $ajax['success'] = true;
        $ajax['message'] = 'Deletado com sucesso';
        echo json_encode($ajax);
        return;
        // return redirect()->route('category.index');
    }
}
