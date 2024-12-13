<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('units')->insert([
            ['name' => 'Networking Unit'],
            ['name' => 'Multimedia'],
            ['name' => 'Programming Unit'],
            ['name' => 't/p connect'],
        ]);
    }
}

