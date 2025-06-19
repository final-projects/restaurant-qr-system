<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // عرض كل الطلبات الخاصة بالمستخدم الحالي
    public function index()
    {
        $orders = Order::with('table', 'menus')
                    ->where('user_id', Auth::id())
                    ->latest()
                    ->paginate(10);

        return view('user.orders.index', compact('orders'));
    }

    // عرض صفحة إضافة طلب جديد
    public function create()
    {
        $tables = Table::all();
        $menus = Menu::with('category')->get();

        return view('user.orders.create', compact('tables', 'menus'));
    }

    // حفظ الطلب الجديد في قاعدة البيانات
    public function store(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'menus'    => 'required|array',
            'menus.*.id'       => 'required|exists:menus,id',
            'menus.*.quantity' => 'required|integer|min:1',
        ]);

        // إنشاء الطلب وربطه بالمستخدم
        $order = Order::create([
            'table_id' => $request->table_id,
            'user_id'  => Auth::id(),
            'status'   => 'new',
        ]);

        // ربط الأصناف المختارة مع الكميات بالطلب
        foreach ($request->menus as $item) {
            $order->menus()->attach($item['id'], [
                'quantity' => $item['quantity']
            ]);
        }

        return redirect()->route('user.orders.index')->with('success', 'تم تنفيذ الطلب بنجاح.');
    }
}
