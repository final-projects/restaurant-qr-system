<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Table;
use App\Models\Order;
use Illuminate\Http\Request;

class PublicMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('category')->where('available', true)->get();

        return view('menu.public', compact('menus'));
    }
    public function menu(Table $table)
    {
        $menus = Menu::with('category')->where('available', true)->get();

        // ✅ Get the latest active order for the table excluding 'old'
        $activeOrder = $table->orders()
            ->where('status', '!=', 'old')
            ->latest()
            ->with('menus') // لو عندك علاقة order->items->menu
            ->first();
        return view('public.menu', compact('table', 'menus', 'activeOrder'));
    }




    public function submit(Request $request, Table $table, Menu $menu)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Create or get open order for this table
        $order = Order::firstOrCreate(
            ['table_id' => $table->id, 'status' => 'preparing'], // Adjust status if needed
            ['total_price' => 0]
        );

        // Attach menu item with quantity (or update if exists)
        $existing = $order->menus()->where('menu_id', $menu->id)->first();

        if ($existing) {
            // If already added, update the pivot quantity
            $order->menus()->updateExistingPivot($menu->id, [
                'quantity' => $existing->pivot->quantity + $request->quantity,
            ]);
        } else {
            $order->menus()->attach($menu->id, [
                'quantity' => $request->quantity,
            ]);
        }

        // Optionally recalculate total price
        $total = 0;
        foreach ($order->menus as $m) {
            $total += $m->price * $m->pivot->quantity;
        }
        $order->update(['total_price' => $total]);

        return back()->with('success', "{$menu->name} added to order with quantity {$request->quantity}.");
    }

}
