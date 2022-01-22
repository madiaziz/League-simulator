<?php

namespace Tests\Feature;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddRemoveTeamsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function test_add_teams()
    {
        $response = $this->put('/api/teams/add');
        $response->assertStatus(200);

        //check if teams are added
        if(Team::where('reserved', 0)->count() == 8){
            $this->assertTrue(true);
        }else{
            $this->assertTrue(false);
        }
        
    }

    public function test_remove_teams()
    {
        $response = $this->put('/api/teams/remove');
        $response->assertStatus(200);

        //check if teams are removed
        if(Team::where('reserved', 0)->count() == 4){
            $this->assertTrue(true);
        }else{
            $this->assertTrue(false);
        }
        
    }
}
