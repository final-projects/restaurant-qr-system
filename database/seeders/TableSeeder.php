<?php

// database/seeders/TableSeeder.php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TableSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Table::create([
                'table_number' => $i,
                'qr_token' => Str::uuid(),
                'seats' => rand(2, 6),
                'status' => rand(0, 1) ? 'available' : 'occupied',
            ]);
        }
    }
}

