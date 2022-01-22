<?php

namespace App\Services;

class GameReportService
{
    private $teams;
    private $currentWeekGames;
    private $currentWeek;
    private $lastWeek;

    public function __construct($teams, $currentWeekGames, $currentWeek, $lastWeek)
    {
        $this->teams = $teams;
        $this->currentWeekGames = $currentWeekGames;
        $this->currentWeek = $currentWeek;
        $this->lastWeek = $lastWeek;
    }

    public function getAllTablesData()
    {
        $leagueTableData = $this->getLeagueTableData($this->teams);
        $gameTableData = $this->currentWeekGames;
        $predictionTableData = $this->getPredictionTableData($this->currentWeek, $leagueTableData);

        return response()->json([
            'leagueTableData' => $leagueTableData,
            'gameTableData' => $gameTableData,
            'predictionTableData' => $predictionTableData,
            'week' => $this->currentWeek,
            'is_final' => $this->currentWeek == $this->lastWeek ? 1 : 0,
        ]);
    }
    
    public function getLeagueTableData($teams)
    {
        //loop through all teams to find each team statistics
        foreach ($teams as $team) {
            $homeGames = $team->homeGames;
            $awayGames = $team->awayGames;

            $team->p = 0;
            $team->w = 0;
            $team->d = 0;
            $team->l = 0;
            $team->gd = 0;
            $team->pts = 0;

            //get home games results 
            $team = $this->calcGameResults($team, $homeGames, true);
            //get away games results
            $team = $this->calcGameResults($team, $awayGames, false);
        }

        //sort results by pts then gd
        $teams =  $teams->sortBy([
            ['pts', 'desc'],
            ['gd', 'desc'],
        ]);
        return $teams->values()->all();
    }

    public function getPredictionTableData($week, $statistics)
    {
        $predictionTableData = [];
        if ($week >= 4) {
            $allTeamsStrengths = 0;

            //get remaining games to play
            $remainingGames = (count($statistics) * 2) - 2  - $statistics[0]->p;

            //add strengths and remove all teams statistics that cant win
            $filteredStatistics = [];
            foreach ($statistics as $teamStatistic) {
                if ($statistics[0]->pts < ($teamStatistic->pts + ($remainingGames * 3))) {
                    array_push($filteredStatistics, $teamStatistic);
                    $allTeamsStrengths += $teamStatistic->pts * ($teamStatistic->att + $teamStatistic->dif + $teamStatistic->mid);
                }
            }

            //loop through all teams that can still win and get predication
            foreach ($filteredStatistics as $teamStatistic) {
                $temp = new \stdClass();
                $temp->team = $teamStatistic->name;
                $temp->prediction = $teamStatistic->pts ? intval($teamStatistic->pts * ($teamStatistic->att + $teamStatistic->dif + $teamStatistic->mid) / $allTeamsStrengths * 100) : 0;
                array_push($predictionTableData, $temp);
            }

            //sort the data by prediction percentage
            usort($predictionTableData, function ($first, $second) {
                return $first->prediction < $second->prediction;
            });
        }
        return $predictionTableData;
    }

    private function calcGameResults($team, $games, $isHome = false)
    {
        //loop through all games and calclate results
        foreach ($games as $game) {
            //add 1 to games played
            $team->p++;

            //if home goals and away goals are equal then its draw 
            if ($game->home_goals == $game->away_goals) {
                $team->pts += 1;
                $team->d += 1;
            }

            //if home goals are more than away goals its a win (Reverse for away games)
            else if ($game->home_goals > $game->away_goals) {
                if ($isHome) {
                    $team->pts += 3;
                    $team->w += 1;
                } else {
                    $team->l += 1;
                }
            }

            //else away goals are more than home goals its a loss (Reverse for away games)
            else {
                if ($isHome) {
                    $team->l += 1;
                } else {
                    $team->pts += 3;
                    $team->w += 1;
                }
            }

            //add number of goals different to gd (Reverse for away games)
            if ($isHome) {
                $team->gd = $team->gd + $game->home_goals - $game->away_goals;
            } else {
                $team->gd = $team->gd + $game->away_goals - $game->home_goals;
            }
        }

        return $team;
    }
}
