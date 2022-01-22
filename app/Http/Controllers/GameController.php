<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\WeekGame;
use App\Models\Team;
use App\Services\GameManagerService;
use App\Services\GameReportService;

class GameController extends Controller
{
    private $gameManagerService;
    private $lastWeek;
    private $currentWeek;

    public function __construct()
    {
        $this->currentWeek = Game::count() ? Game::orderBy('id', 'desc')->first()->weekGame->week : 0;
        $this->lastWeek = WeekGame::count() ? WeekGame::orderBy('week', 'desc')->first()->week : 0;
        $this->gameManagerService = new GameManagerService();
    }

    public function getCurrentWeek()
    {
        $teams = Team::where('reserved', 0)->get();
        $currentWeekGames = WeekGame::with('game', 'homeTeam', 'awayTeam')->where('week', $this->currentWeek)->get()->groupBy('week');
        $allWeekGames = WeekGame::with('game', 'homeTeam', 'awayTeam')->get()->groupBy('week');
        if ($this->currentWeek == $this->lastWeek) {
            $gameReportService = new GameReportService($teams, $allWeekGames, $this->currentWeek, $this->lastWeek);
        } else {
            $gameReportService = new GameReportService($teams, $currentWeekGames, $this->currentWeek, $this->lastWeek);
        }
        return $gameReportService->getAllTablesData();
    }

    public function goToNextWeek($week)
    {
        $this->currentWeek++;
        $weekGames = WeekGame::with(['homeTeam', 'awayTeam'])->where('week', $week)->get();
        $playedWeekGames = $this->gameManagerService->playNextWeekGames($weekGames);
        Game::insert($playedWeekGames);

        return $this->getCurrentWeek();
    }

    public function goToLastWeek()
    {
        while ($this->currentWeek < $this->lastWeek) {
            $this->currentWeek++;
            $weekGames = WeekGame::with(['homeTeam', 'awayTeam'])->where('week', $this->currentWeek)->get();
            $playedWeekGames = $this->gameManagerService->playNextWeekGames($weekGames);
            Game::insert($playedWeekGames);
        }
        return $this->getCurrentWeek();
    }

    public function restart()
    {
        $this->currentWeek = 0;
        WeekGame::truncate();
        Game::truncate();

        $teams = Team::where('reserved', 0)->get()->toArray();
        $weekGames = $this->gameManagerService->generateWeekGames($teams);
        WeekGame::insert($weekGames);

        return $this->getCurrentWeek();
    }
}
