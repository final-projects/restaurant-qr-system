<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $orders = Order::with('table')->latest()->get();
        return view('admin.dashboard', compact('orders'));
    }

    public function view($id)
    {
        $order = Order::with(['table', 'orderItems.menuItem'])->findOrFail($id);
        return view('admin.view', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|string']);
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated.');
    }

    public function delete($id)
    {
        Order::findOrFail($id)->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Order deleted.');
    }
}
