<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\WeekGame;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlayNextWeekGamesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function test_play_next_week_games()
    {
        $response = $this->put('/api/weeks/0/next');
        $response->assertStatus(200);

        //check if next week games are played
        if(Game::count() == WeekGame::where('week', 1)->count()){
            $this->assertTrue(true);
        }else{
            $this->assertTrue(false);
        }
    }
}
