<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    public function run()
    {
        $items = [
            'Laptop',
            'Car',
            'Toetsenbord',
            'Monitor',
            'Muis',
            'Tablet',
            'Smartphone',
            'Camera',
            'Headset',
        ];

        foreach ($items as $index => $item) {
            // Haal het group id op voor de huidige item naam
            $group = DB::table('group')->where('name', $item)->first();

            if ($group) {
                DB::table('item_id')->insert([
                    'groupid' => $group->id,
                    'name' => $item,
                    'aanschafdatum' => '2023-0' . ($index % 9 + 1) . '-01',
                    'tiernummer' => 'Tier ' . ($index % 3 + 1),
                    'status' => $index % 2 == 0 ? 'active' : 'inactive',
                    'picture' => 'path/to/picture' . ($index + 1) . '.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                // Foutmelding als de groep niet bestaat
                $this->command->error("Group for item '{$item}' not found!");
            }
        }
    }
}

