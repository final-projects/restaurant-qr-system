<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        $orders = Order::with('table')->latest()->get();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        $tables = Table::all(); // For table selection
        $menus = Menu::with('category')->get(); // For menu item checkboxes

        return view('admin.orders.create', compact('tables', 'menus'));
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'status' => 'required|in:pending,processing,completed,canceled',
        ]);

        Order::create([
            'table_id' => $request->table_id,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        $tables = Table::all();

        return view('admin.orders.edit', compact('order', 'tables'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'status' => 'required|in:pending,processing,completed,canceled',
        ]);

        $order->update([
            'table_id' => $request->table_id,
            'status' => $request->status,
        ]);

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
