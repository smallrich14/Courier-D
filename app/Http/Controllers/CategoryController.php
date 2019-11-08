<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Item;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $items = Item::all();
        // $this->authorize('view', $category);
        $categories = Category::all();
        // dd($categories);

        return view('categories.index')->with('categories', $categories)->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        $this->authorize('create', $category);
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        $this->authorize('create', $category);
         //validation for categories 
        $request->validate([
            'category' => 'required|string|unique:categories,name'
        ]);

        // this will store in database
        Category::create([
            'name' => $request->input('category')
        ]);

        // for error handling
        $request->session()->flash('category_message', 'Category Successfully Added!');

        return redirect(route('categories.create'));


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $this->authorize('view', $category);

        return view('category.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $this->authorize('update', $category);
        return view('categories.create')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('update', $category);
         
        $request->validate([
            'category' => 'required|string|unique:categories,name'
        ]);

        $category->update([
            'name' => $request->input('category')
        ]);

        $request->session()->flash('category_message', 'Category Successfully Updated!');

        return redirect(route('categories.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        $category->delete();

        return redirect(route('categories.index'))->with('destroy_message', 'Product Deleted');

    }
}
