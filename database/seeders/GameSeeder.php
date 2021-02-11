<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->truncate();
        DB::table('games')->insert([
            0 => ['home_team' => 1, 'away_team' => 2,'home_score' =>3,'away_score' =>1, 'week' => 1],
            1 => ['home_team' => 3, 'away_team' => 4,'home_score' =>1,'away_score' =>1, 'week' => 1],
            2 => ['home_team' => 1, 'away_team' => 3,'home_score' =>2,'away_score' =>4, 'week' => 2],
            3 => ['home_team' => 2, 'away_team' => 4,'home_score' =>3,'away_score' =>1, 'week' => 2],
            4 => ['home_team' => 1, 'away_team' => 4,'home_score' =>6,'away_score' =>2, 'week' => 3],
            5 => ['home_team' => 2, 'away_team' => 3,'home_score' =>2,'away_score' =>1, 'week' => 3],
            6 => ['home_team' => 2, 'away_team' => 1,'home_score' =>2,'away_score' =>1, 'week' => 4],
            7 => ['home_team' => 4, 'away_team' => 3,'home_score' =>2,'away_score' =>1, 'week' => 4],
            8 => ['home_team' => 3, 'away_team' => 1,'home_score' =>2,'away_score' =>4, 'week' => 5],
            9 => ['home_team' => 4, 'away_team' => 2,'home_score' =>3,'away_score' =>1, 'week' => 5],
            10 => ['home_team' => 4, 'away_team' => 1,'home_score' =>1,'away_score' =>3, 'week' => 6],
            11 => ['home_team' => 3, 'away_team' => 2,'home_score' =>2,'away_score' =>2, 'week' => 6],
        ]);
    }
}
