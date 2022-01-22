<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\WeekGame;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlayAllWeeksGamesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function test_play_all_weeks_games()
    {
        $response = $this->put('/api/weeks/0/last');
        $response->assertStatus(200);

        //check if all games are played
        if(Game::count() == WeekGame::count()){
            $this->assertTrue(true);
        }else{
            $this->assertTrue(false);
        }
    }
}
