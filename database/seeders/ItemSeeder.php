<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    public function run()
    {
        DB::table('item_id')->insert([
            ['id' => 1, 'name' => 'Car', 'code' => 'CAR001'],
            ['id' => 2, 'name' => 'Token', 'code' => 'TOK002'],
            ['id' => 3, 'name' => 'Key', 'code' => 'KEY003'],
            ['id' => 4, 'name' => 'Car', 'code' => 'CAR004'],
            ['id' => 5, 'name' => 'Token', 'code' => 'TOK005'],
            ['id' => 6, 'name' => 'Key', 'code' => 'KEY006'],
        ]);
    }
}

