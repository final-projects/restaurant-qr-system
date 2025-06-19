<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Table;
use App\Models\User;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $tables = Table::all();
        $menus = Menu::all();

        if ($users->isEmpty() || $tables->isEmpty() || $menus->isEmpty()) {
            $this->command->warn('You need to seed users, tables, and menus first.');
            return;
        }

        // Create 10 sample orders
        for ($i = 0; $i < 10; $i++) {
            $order = Order::create([
                'user_id' => $users->random()->id,
                'table_id' => $tables->random()->id,
                'status' => ['new', 'preparing', 'completed'][rand(0, 2)],
            ]);

            // Add 1-4 random menu items per order
            $selectedMenus = $menus->random(rand(1, 4));

            foreach ($selectedMenus as $menu) {
                $order->menus()->attach($menu->id, [
                    'quantity' => rand(1, 3),
                ]);
            }
        }
    }
}
