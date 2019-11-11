<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use App\Category;
use Str;
use DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        // dd($request->query('category')); filter category
        if($request->query('category')){
            $items = Item::all()->where('category_id', $request->query('category'));
        }else {
            $items = Item::all();
        }

        return view('items.index')->with('items', $items)->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Item $item)
    {
        $this->authorize('create', $item);
        $categories = Category::all();
        return view('items.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Item $item)
    {
        $this->authorize('create', $item);
        $request->validate([
            'name' => 'required|string',
            'category' => 'required',
            'image' => 'required|image|max:20000',
            'description' => 'required|string',
        ]);

        $file = $request->file('image');

        $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            // 2.3 get uploaded file extension name
            $file_extension = $file->extension();

            // 2.4 generate new name with random characters 
            $random_chars = Str::random(10);

            $new_file_name = date('Y-m-d-H-i-s') . "_" . $random_chars . "_" . $file_name . "." . $file_extension;

            // dd($new_file_name);

             // 2.5 save the new file to public folder
            $filepath = $file->storeAs('images', $new_file_name,'public');

            //== // 3. get input values from form
            $name = $request->input('name');
            $price = $request->input('price');
            $category_id = $request->input('category');
            $description = $request->input('description');
            $image = $filepath;

            //== // 4. save the details to the database
            $item = new Item;
            $item->name = $name;
            $item->category_id = $category_id;
            $item->description = $description;
            $item->image = $image;

            $item->save();

        $request->session()->flash('item_message', 'Unit Successfully Added!');

          //== // 5. redirect user to view the newly created product
        return redirect(route('items.show', ['item'=> $item->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('items.show')->with('items', $item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $this->authorize('update', $item);
        $categories = Category::all();
        return view('items.edit')->with('item', $item)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $this->authorize('update', $item);
        $request->validate([
            'name' => 'required|string',
            'category' => 'required',
            'description' => 'required|string',
        ]);

       if(
            !$request->hasFile('image') &&
            $item->name == $request->input('name') &&
            $item->description == $request->input('description') &&
            $item->category_id == $request->input('category') 

        ){
            $request->session()->flash('update_failed', 'No changes made');
            
        }else {
            // update the entry in the database and return the updated entry

            // check if there's a file uploaded
            if($request->hasFile('image')){
                $request->validate([
                    'image' => 'required|image|max:20000'
                ]);

                $file = $request->file('image');
                $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $file_extension = $file->extension();
                $random_chars = Str::random(10);
                $new_file_name = date('Y-m-d-H-i-s') . "_" . $random_chars . "_" . $file_name . "." . $file_extension;

                $filepath = $file->storeAs('images', $new_file_name,'public');

                // set the new image path as image value of product
                $item->image = $filepath;
            }


             //  update attributes
            $item->name = $request->input('name');
            $item->category_id = $request->input('category');
            $item->description = $request->input('description');

            $item->save();

        $request->session()->flash('update_success', 'Item Successfully Updated!');

          // redirect user to view the newly created product
        return redirect(route('items.show', ['item'=> $item->id]));
    }

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $this->authorize('delete', $item);
        $item->delete();

        return redirect(route('items.index'))->with('destroy_message', 'Unit Deleted');
    }

}
