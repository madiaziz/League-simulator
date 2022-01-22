<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\WeekGame;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RestartGamesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function test_restart_games()
    {
        $response = $this->put('/api/weeks/0/last');
        $response->assertStatus(200);

        //check if games are not played
        if (Game::count() != WeekGame::count()) {
            $this->assertTrue(false);
        } 

        $response = $this->put('/api/weeks/restart');
        $response->assertStatus(200);

        //check if game restarted
        if(Game::count() == 0){
            $this->assertTrue(true);
        }else{
            $this->assertTrue(false);
        }
    }
}
