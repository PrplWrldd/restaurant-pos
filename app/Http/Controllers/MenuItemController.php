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
        {
            $menuItems = [
                ['name' => 'Nasi Lemak', 'price' => 'RM3', 'image' => 'menu/nasi-lemak.jpeg', 'rating' => '4.9'],
                ['name' => 'Nasi Goreng Kampung', 'price' => 'RM6', 'image' => 'menu/nasi-goreng-kampung.jpg','rating' => '4.8'],
                ['name' => 'Nasi Goreng Pattaya', 'price' => 'RM6', 'image' => 'menu/nasi-goreng-pattaya.jpg','rating' => '4.8'],
                ['name' => 'Nasi Goreng Cina', 'price' => 'RM6', 'image' => 'menu/nasi-goreng-cina.jpg','rating' => '4.8'],
                ['name' => 'Maggi Goreng Basah', 'price' => 'RM4', 'image' => 'menu/maggi-goreng-basah.jpg','rating' => '4.8'],
                ['name' => 'Kuetiau Goreng', 'price' => 'RM4', 'image' => 'menu/kuetiau-goreng.jpeg','rating' => '4.8'],
            ];

            $favDishes = [
                ['name' => 'Nasi Lemak', 'image' => 'menu/nasi-lemak.jpeg'],
                ['name' => 'Burger', 'image' => 'menu/burger.jpg'],
                ['name' => 'Roti Canai', 'image' => 'menu/roti-canai.jpg'],
                ['name' => 'Gepuk', 'image' => 'menu/gepuk.jpeg'],
                ['name' => 'Chicken Mix', 'image' => 'menu/chicken-mix.jpg'],
                ['name' => 'Geprek', 'image' => 'menu/geprek.jpg'],
                ['name' => 'Mee Tarik', 'image' => 'menu/mee-tarik.jpeg'],
                ['name' => 'Dumplings', 'image' => 'menu/dumplings.jpg'],
                ['name' => 'Sandwich', 'image' => 'menu/sandwich.jpg'],
                ['name' => 'Nasi Arab', 'image' => 'menu/nasi-arab.jpg'],
                ['name' => 'Yogurt', 'image' => 'menu/yogurt.jpg'],
            ];
    
            return view('home', compact('menuItems', 'favDishes'));
        }
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
