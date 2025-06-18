<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function showMenu(Request $request)
    {
        $token = $request->query('table');

        $table = Table::where('qr_token', $token)->firstOrFail();
        $menuItems = MenuItem::all();

        return view('order.menu', compact('table', 'menuItems'));
    }

    public function submitOrder(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'items' => 'required|array',
        ]);

        $order = Order::create([
            'table_id' => $request->table_id,
            'status' => 'new',
        ]);

        foreach ($request->items as $itemId => $quantity) {
            if ($quantity > 0) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $itemId,
                    'quantity' => $quantity,
                ]);
            }
        }

        return redirect()->route('order.menu', ['table' => $request->input('token')])
                         ->with('success', 'Your order has been placed successfully.');
    }
}
