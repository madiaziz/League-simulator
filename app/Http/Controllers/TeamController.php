<?php

namespace App\Http\Controllers;

use App\Models\Team;

class TeamController extends Controller
{

    public function addTeams()
    {
        Team::inRandomOrder()->where('reserved', 1)->limit(4)
            ->update([
                'reserved' => '0'
            ]);

        $gameController = new GameController();
        return $gameController->restart();
    }

    public function removeTeams()
    {
        if (Team::where('reserved', 0)->count() >= 8) {
            Team::inRandomOrder()->where('reserved', 0)->limit(4)
                ->update([
                    'reserved' => '1'
                ]);
        }

        $gameController = new GameController();
        return $gameController->restart();
    }
}
