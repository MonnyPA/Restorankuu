<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('admin.item.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.item.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'required|boolean'
        ],
        [
            'name.required' => 'The Item Name is required',
            'description.string' => 'The Description must be a String',
            'price.required' => 'The Price is required',
            'category_id.required' => 'The Category is required',
            'img.image' => 'The Image must be an image file',
            'img.max' => 'The Image size must not exceed 2MB',
            'is_active.required' => 'The Active Status is required',
            'is_active.boolean' => 'The Active Status must be true or false.'
        ]);

        // Handle Image
        if ($request->hasFile('img'))
            {
                $image = $request->file('img');
                $imageNames = time().'.'. $image->getClientOriginalExtension();
                $image->move(public_path('img_item_upload'), $imageNames);
                $validate['img'] = $imageNames;
            }

        // Jika berhasil

        Item::create($validate);

        return redirect()->route('items.index')->with('success', 'Menu : ' . $validate['name'] . ', created successfully.');
    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {

    }


    public function update(Request $request, string $id)
    {

    }


    public function destroy(string $id)
    {

    }
}
