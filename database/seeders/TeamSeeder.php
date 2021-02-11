<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
           0 => ['id' => 1, 'name' => 'Arsenal'],
           1 => ['id' => 2, 'name' => 'Chelsea'],
           2 => ['id' => 3, 'name' => 'Manchester City'],
           3 => ['id' => 4, 'name' => 'Liverpool'],
        ]);
    }
}
