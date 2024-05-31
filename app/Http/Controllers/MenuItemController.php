<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    // Other CRUD methods...

    // Method to display the list of menu items
    public function index()
    {
        $menuItems = MenuItem::all();
        return view('admin.menu.index', compact('menuItems'));
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
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
        ]);

        MenuItem::create($request->only(['name', 'price', 'description']));
        return redirect()->route('menu-items.index')->with('success', 'Menu Item created successfully.');
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
        ]);

        $menuItem->update($request->only(['name', 'price', 'description']));
        return redirect()->route('menu-items.index')->with('success', 'Menu Item updated successfully.');
    }

    // Method to delete a menu item
    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();
        return redirect()->route('menu-items.index')->with('success', 'Menu Item deleted successfully.');
    }
}
