<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Add this line

class MenuItemController extends Controller
{
    // Other CRUD methods...

    // Method to display the list of menu items
    public function index()
    {
        $menuItems = MenuItem::all();
        return view('menu.index', compact('menuItems'));
    }

    // Method to show the form for creating a new menu item
    public function create()
    {
        return view('admin.menu.create');
    }

    // Method to store a new menu item
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu_images', 'public');
        }

        MenuItem::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('menu-items.index')->with('success', 'Menu item created successfully.');
    }

    // Method to show the form for editing an existing menu item
    public function edit(MenuItem $menuItem)
    {
        return view('admin.menu.edit', compact('menuItem'));
    }

    // Method to update an existing menu item
    public function update(Request $request, MenuItem $menuItem)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($menuItem->image_path) {
                Storage::disk('public')->delete($menuItem->image_path);
            }
            $menuItem->image_path = $request->file('image')->store('menu_images', 'public');
        }

        $menuItem->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image_path' => $menuItem->image_path,
        ]);

        return redirect()->route('menu-items.index')->with('success', 'Menu item updated successfully.');
    }

    // Method to delete a menu item
    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();
        return redirect()->route('menu-items.index')->with('success', 'Menu Item deleted successfully.');
    }

    
}
