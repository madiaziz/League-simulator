<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'week_game_id',
        'home_goals',
        'away_goals'
    ];

    public function weekGame()
    {
        return $this->belongsTo(WeekGame::class, 'week_game_id');
    }
}
