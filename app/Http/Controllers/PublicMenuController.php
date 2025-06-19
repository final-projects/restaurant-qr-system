<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class PublicMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('category')->where('available', true)->get();

        return view('menu.public', compact('menus'));
    }
}
