<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all()->sortBy('name');
        return view('admin.item.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::orderBy('cat_name', 'asc')->get();
        return view('admin.item.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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

    public function show(Item $item)
    {
        return view('admin.item.show', compact('item'));
    }

    public function edit(string $id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::orderBy('cat_name', 'asc')->get();
        return view('admin.item.edit', compact('item','categories'));

    }

    public function markAsActive(int $id)
    {
        $item = Item::find($id);
        $item->update(['is_active' => 1]);

        return redirect()->route('items.index')->with('success', 'Menu ' . $item->name . ' marked as active successfully.');
    }

    public function markAsNonactive(int $id)
    {
        $item = Item::find($id);
        $item->update(['is_active' => 0]);

        return redirect()->route('items.index')->with('success', 'Menu ' . $item->name . ' marked as non active successfully.');
    }

    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'img' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
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
        $item = Item::findOrFail($id);
        $item->update($validate);

        return redirect()->route('items.index')->with('success', 'Menu : ' . $validate['name'] . ', Update successfully.');
    }


    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Menu : ' . $item->name . ', Deleted successfully.');
    }
}
