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
            [
                'name' => 'Manchester City',
                'att' => 85,
                'mid' => 85,
                'dif' => 86,
                'reserved' => 0,
            ], [
                'name' => 'Liverpool',
                'att' => 86,
                'mid' => 83,
                'dif' => 85,
                'reserved' => 0,
            ], [
                'name' => 'Manchester United',
                'att' => 85,
                'mid' => 84,
                'dif' => 83,
                'reserved' => 1,
            ], [
                'name' => 'Chelsea',
                'att' => 84,
                'mid' => 86,
                'dif' => 81,
                'reserved' => 0,
            ],
            [
                'name' => 'Tottenham Hotspur',
                'att' => 86,
                'mid' => 80,
                'dif' => 80,
                'reserved' => 1,
            ], [
                'name' => 'Leicester City',
                'att' => 82,
                'mid' => 81,
                'dif' => 79,
                'reserved' => 1,
            ], [
                'name' => 'Arsenal',
                'att' => 83,
                'mid' => 81,
                'dif' => 77,
                'reserved' => 0,
            ], [
                'name' => 'West Ham United',
                'att' => 79,
                'mid' => 79,
                'dif' => 79,
                'reserved' => 1,
            ]
            , [
                'name' => 'Everton',
                'att' => 79,
                'mid' => 78,
                'dif' => 79,
                'reserved' => 1,
            ]
            , [
                'name' => 'Wolverhampton',
                'att' => 78,
                'mid' => 81,
                'dif' => 77,
                'reserved' => 1,
            ]
            , [
                'name' => 'Aston Villa',
                'att' => 78,
                'mid' => 76,
                'dif' => 77,
                'reserved' => 1,
            ]
            , [
                'name' => 'Leeds United',
                'att' => 78,
                'mid' => 78,
                'dif' => 76,
                'reserved' => 1,
            ]
            , [
                'name' => 'Newcastle United',
                'att' => 79,
                'mid' => 75,
                'dif' => 74,
                'reserved' => 1,
            ]
            , [
                'name' => 'Crystal Palace',
                'att' => 77,
                'mid' => 76,
                'dif' => 74,
                'reserved' => 1,
            ]
            , [
                'name' => 'Southampton',
                'att' => 76,
                'mid' => 77,
                'dif' => 73,
                'reserved' => 1,
            ]
            , [
                'name' => 'Burnley',
                'att' => 76,
                'mid' => 76,
                'dif' => 77,
                'reserved' => 1,
            ]
            , [
                'name' => 'Brighton & Hove Albion',
                'att' => 75,
                'mid' => 77,
                'dif' => 75,
                'reserved' => 1,
            ]
            , [
                'name' => 'Watford',
                'att' => 74,
                'mid' => 75,
                'dif' => 73,
                'reserved' => 1,
            ]
            , [
                'name' => 'Norwich City',
                'att' => 76,
                'mid' => 74,
                'dif' => 74,
                'reserved' => 1,
            ]
            , [
                'name' => 'Brentford',
                'att' => 73,
                'mid' => 74,
                'dif' => 73,
                'reserved' => 1,
            ]
        ]);
    }
}
