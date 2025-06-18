<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin order dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.dashboard', [
            'ordersCount' => Order::count(),
            'tablesCount' => Table::count(),
            'categoriesCount' => Category::count(),
            'menuItemsCount' => MenuItem::count(),
            'recentOrders' => Order::with('table')->latest()->take(5)->get(),
        ]);
    }

}
