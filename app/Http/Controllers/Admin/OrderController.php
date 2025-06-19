<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Table;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        $orders = Order::with(['table', 'menus', 'user'])->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        $tables = Table::all();
        $menus = Menu::with('category')->get();
        $users = User::all();
        return view('admin.orders.create', compact('tables', 'menus', 'users'));
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'status' => 'required|in:new,preparing,completed',
            'menus' => 'required|array',
        ]);

        $filteredMenus = collect($request->menus)->filter(fn($qty) => intval($qty) > 0);

        if ($filteredMenus->isEmpty()) {
            return back()->withErrors(['menus' => 'Please add at least one item with quantity greater than 0.'])->withInput();
        }

        $order = Order::create([
            'table_id' => $request->table_id,
            'user_id' => $request->user_id,
            'status' => $request->status,
        ]);

        foreach ($filteredMenus as $menuId => $quantity) {
            $order->menus()->attach($menuId, ['quantity' => intval($quantity)]);
        }

        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully.');
    }


    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $order->load(['table', 'menus', 'user']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        $tables = Table::all();
        $menus  = Menu::with('category')->get();
        $users  = User::all();
        $order->load('menus');

        return view('admin.orders.edit', compact('order', 'tables', 'menus', 'users'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'status'   => 'required|in:new,preparing,completed',
            'menus'    => 'required|array',
        ]);

        // Filter out menu items with quantity > 0
        $filteredMenus = collect($request->menus)->filter(fn($qty) => intval($qty) > 0);

        if ($filteredMenus->isEmpty()) {
            return back()->withErrors(['menus' => 'Please add at least one item with quantity greater than 0.'])->withInput();
        }

        // Update main order data
        $order->update([
            'table_id' => $request->table_id,
            'user_id'  => $request->user_id,
            'status'   => $request->status,
        ]);

        // Sync menu items with quantities
        $syncData = [];
        foreach ($filteredMenus as $menuId => $quantity) {
            $syncData[$menuId] = ['quantity' => intval($quantity)];
        }

        $order->menus()->sync($syncData);

        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully.');
    }


    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }
}
