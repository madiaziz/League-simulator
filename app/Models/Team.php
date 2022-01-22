<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    /**
     * Get all of the homeGames for the Team
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function homeGames()
    {
        return $this->hasManyThrough(Game::class, WeekGame::class, 'home_team_id');
    }

    /**
     * Get all of the awayGames for the Team
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function awayGames()
    {
        return $this->hasManyThrough(Game::class, WeekGame::class, 'away_team_id');
    }
}
