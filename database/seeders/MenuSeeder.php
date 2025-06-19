<?php


namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class MenuSeeder extends Seeder
{

    public function run(): void
    {
        $categoryIds = Category::pluck('id')->all();

        $items = [
            ['Grilled Chicken', 85.00, 'chicken.jpg', 'Juicy grilled chicken.'],
            ['Chocolate Cake', 45.00, 'cake.jpg', 'Delicious chocolate cake.'],
            ['Beef Burger', 75.00, 'burger.jpg', 'Grilled beef burger with cheese.'],
            ['Pasta Alfredo', 65.00, 'pasta.jpg', 'Creamy Alfredo pasta.'],
            ['Mango Juice', 20.00, 'mango.jpg', 'Fresh mango juice.'],
            ['Greek Salad', 35.00, 'salad.jpg', 'Healthy Greek salad.'],
            ['Pizza Margherita', 90.00, 'pizza.jpg', 'Classic Italian pizza.'],
            ['Ice Cream Sundae', 30.00, 'icecream.jpg', 'Vanilla ice cream with syrup.'],
        ];

        foreach ($items as [$name, $price, $image, $desc]) {
            Menu::create([
                'name' => $name,
                'price' => $price,
                'category_id' => Arr::random($categoryIds),
                'description' => $desc,
                'image' => 'menus/' . $image,
                'available' => true,
            ]);
        }
    }

}
