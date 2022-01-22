<?php

namespace App\Services;

class GameManagerService
{

    public function generateWeekGames($teams)
    {
        $teamCount = count($teams);

        if ($teamCount == 0) {
            return;
        }

        //shuffle teams randomly
        shuffle($teams);

        //get first team and freeze it 
        $freezedTeam = $teams[0];

        //loop through all teams and add games for all other teams
        //Using Scheduling classic algorithm (Circle method)
        //remove first team so we can circulate the array
        array_shift($teams);

        //add games for all teams 
        $weekGames = [];
        foreach ($teams as $index => $team) { 
            $allTeams = $teams;
            array_unshift($allTeams, $freezedTeam);
            for ($x = 1; $x <= $teamCount / 2; $x++) { 
                //add one game home and one game away to array
                $weekGames[] = [
                    'home_team_id' => $allTeams[$x - 1]['id'],
                    'away_team_id' => $allTeams[$x + ($teamCount / 2) - 1]['id'], 
                    'week' => $index + 1,
                ];
                $weekGames[] = [
                    'away_team_id' => $allTeams[$x - 1]['id'],
                    'home_team_id' => $allTeams[$x + ($teamCount / 2) - 1]['id'], 
                    'week' => $index + $teamCount,
                ];
            }
            //rotate teams
            array_push($teams, array_shift($teams));
        }
        return $weekGames;
    }


    public function playNextWeekGames($weekGames)
    {
        
        // loop through all games that should be played this week and generate random results influenced by strengths        
        $finalWeekGames = [];
        foreach ($weekGames as $weekGame) {
            $finalWeekGames[] = [
                'week_game_id' => $weekGame->id,
                'home_goals' => $this->getRandGoals($weekGame->homeTeam, $weekGame->awayTeam),
                'away_goals' => $this->getRandGoals($weekGame->awayTeam, $weekGame->homeTeam),
            ];
        }
        return $finalWeekGames;
    }

    public function getRandGoals($homeTeam, $awayTeam)
    {
        //get teams strengths
        $homeStrength = $homeTeam->att + $homeTeam->mid + $homeTeam->dif;
        $awayStrength = $awayTeam->att + $awayTeam->mid + $awayTeam->dif;

        //generate random goals based on their strength
        $strengthDif = $homeStrength - $awayStrength;

        //if home team is weaker it's harder to get points
        if ($strengthDif < 0) {
            $strengthDif = $strengthDif * -1;
            $goals = rand(0, 1) + floor(rand(1, rand(0, 7 / $strengthDif + rand(0, 6)))); 
        } else {
            $goals = rand(0, 1) + floor(rand(1, rand(0, $strengthDif / 12 + rand(0, 6)))); 
        }

        return $goals;
    }
}
