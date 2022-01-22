<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\GameManagerService;


class genrateWeekGamesTest extends TestCase
{
    public $teams = [
        [
            'id' => 1,
            'name' => 'Manchester City',
            'att' => 85,
            'mid' => 85,
            'dif' => 86,
            'reserved' => 0,
        ], [
            'id' => 2,
            'name' => 'Liverpool',
            'att' => 86,
            'mid' => 83,
            'dif' => 85,
            'reserved' => 0,
        ], [
            'id' => 3,
            'name' => 'Manchester United',
            'att' => 85,
            'mid' => 84,
            'dif' => 83,
            'reserved' => 1,
        ], [
            'id' => 4,
            'name' => 'Chelsea',
            'att' => 84,
            'mid' => 86,
            'dif' => 81,
            'reserved' => 0,
        ],
        [
            'id' => 5,
            'name' => 'Tottenham Hotspur',
            'att' => 86,
            'mid' => 80,
            'dif' => 80,
            'reserved' => 1,
        ], [
            'id' => 6,
            'name' => 'Leicester City',
            'att' => 82,
            'mid' => 81,
            'dif' => 79,
            'reserved' => 1,
        ], [
            'id' => 7,
            'name' => 'Arsenal',
            'att' => 83,
            'mid' => 81,
            'dif' => 77,
            'reserved' => 0,
        ], [
            'id' => 8,
            'name' => 'West Ham United',
            'att' => 79,
            'mid' => 79,
            'dif' => 79,
            'reserved' => 1,
        ], [
            'id' => 9,
            'name' => 'Everton',
            'att' => 79,
            'mid' => 78,
            'dif' => 79,
            'reserved' => 1,
        ], [
            'id' => 10,
            'name' => 'Wolverhampton',
            'att' => 78,
            'mid' => 81,
            'dif' => 77,
            'reserved' => 1,
        ], [
            'id' => 11,
            'name' => 'Aston Villa',
            'att' => 78,
            'mid' => 76,
            'dif' => 77,
            'reserved' => 1,
        ], [
            'id' => 12,
            'name' => 'Leeds United',
            'att' => 78,
            'mid' => 78,
            'dif' => 76,
            'reserved' => 1,
        ], [
            'id' => 13,
            'name' => 'Newcastle United',
            'att' => 79,
            'mid' => 75,
            'dif' => 74,
            'reserved' => 1,
        ], [
            'id' => 14,
            'name' => 'Crystal Palace',
            'att' => 77,
            'mid' => 76,
            'dif' => 74,
            'reserved' => 1,
        ], [
            'id' => 15,
            'name' => 'Southampton',
            'att' => 76,
            'mid' => 77,
            'dif' => 73,
            'reserved' => 1,
        ], [
            'id' => 16,
            'name' => 'Burnley',
            'att' => 76,
            'mid' => 76,
            'dif' => 77,
            'reserved' => 1,
        ], [
            'id' => 17,
            'name' => 'Brighton & Hove Albion',
            'att' => 75,
            'mid' => 77,
            'dif' => 75,
            'reserved' => 1,
        ], [
            'id' => 18,
            'name' => 'Watford',
            'att' => 74,
            'mid' => 75,
            'dif' => 73,
            'reserved' => 1,
        ], [
            'id' => 19,
            'name' => 'Norwich City',
            'att' => 76,
            'mid' => 74,
            'dif' => 74,
            'reserved' => 1,
        ], [
            'id' => 20,
            'name' => 'Brentford',
            'att' => 73,
            'mid' => 74,
            'dif' => 73,
            'reserved' => 1,
        ]
    ];

    public function test_generate_week_games()
    {
        $gameManagerService = new GameManagerService();
        
        //test generating games for 4,6,8... 20 teams 
        for ($i=4; $i <= 20; $i+=2) { 
            shuffle($this->teams);
            $weekGames = $gameManagerService->generateWeekGames(array_slice($this->teams, 0, $i));
            
            //check if total games is correct
            if(count($weekGames) != ($i * ($i - 1)) ){
                $this->assertTrue(false);
            }
        }

        $this->assertTrue(true);
    }


    public function test_rand_goals()
    {
        $gameManagerService = new GameManagerService();
        
        for ($i=0; $i <= 1000; $i++) { 
            shuffle($this->teams);
            
            $goals = $gameManagerService->getRandGoals((object) $this->teams[0], (object) $this->teams[1]);
            if($goals < 0){
                $this->assertTrue(false);
            }
        }
        
        $this->assertTrue(true);
    }
}
