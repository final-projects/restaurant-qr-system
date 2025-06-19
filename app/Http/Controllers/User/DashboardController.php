<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('user.dashboard', [
            'orders_count'     => $user->orders()->count(),
            'orders_preparing' => $user->orders()->where('status', 'preparing')->count(),
            'orders_completed' => $user->orders()->where('status', 'completed')->count(),
        ]);
    }
}
