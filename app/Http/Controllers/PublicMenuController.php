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
   /**
     * Show available menu items and active order for this table.
     */
    public function menu(Table $table)
    {
        // ✅ Load all available menus with category info
        $menus = Menu::with('category')->where('available', true)->get();

        // ✅ Get the latest active order for this table (excluding 'old')

        // dd($table ->load('orders.menus'));
        $activeOrder = $table->orders()
            ->where('status', '!=', 'old')
            ->latest()
            ->with('menus') // load menus with pivot
            ->first();
        // dd($activeOrder);
        return view('public.menu', compact('table', 'menus', 'activeOrder'));
    }

    /**
     * Handle submission of menu item to current table's order.
     */
    public function submit(Request $request, Table $table, Menu $menu)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // ✅ Get or create a current 'preparing' order for this table
        $order = Order::firstOrCreate(
            ['table_id' => $table->id, 'status' => 'preparing'],
            ['total_price' => 0]
        );

        // ✅ If menu already exists in order, increase quantity
        $existing = $order->menus()->where('menu_id', $menu->id)->first();

        if ($existing) {
            $order->menus()->updateExistingPivot($menu->id, [
                'quantity' => $existing->pivot->quantity + $request->quantity,
            ]);
        } else {
            $order->menus()->attach($menu->id, [
                'quantity' => $request->quantity,
            ]);
        }

        // ✅ Recalculate total price
        $total = $order->menus->sum(fn($m) => $m->price * $m->pivot->quantity);
        $order->update(['total_price' => $total]);

        return back()->with('success', "{$menu->name} added to order with quantity {$request->quantity}.");
    }

}
