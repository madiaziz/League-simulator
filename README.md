## About Simulator

The goal of this simulator is to predicate and generate the outcome of football matches, It does that based on the difference between team strengths. The simulator randomly picking teams calculate and schedules home and way matches for each team.

[League Simulator Demo](https://league.bebonobo.com/) 

## Main Methods

### Scheduling weekly games method
[Create a schedule for a round-robin tournament](https://en.wikipedia.org/wiki/Round-robin_tournament)  
To schedules home and way matches for each team.
```php
//shuffle teams randomly
shuffle($teams);

//get first team and freeze it 
$freezedTeam = $teams[0];

//loop through all teams and add games for all other teams
//Using Scheduling classic algorithm (Circle method)
//remove first team so we can circulate the array
array_shift($teams);
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
```

### Calculate scores methods
```php
rand(0, 1) + floor(rand(1, rand(0, 7 / $strengthDif + rand(0, 6)))); 
```

```php
rand(0, 1) + floor(rand(1, rand(0, $strengthDif / 12 + rand(0, 6)))); 
```
To generate random scores based on the teams strengths and where the game is being played.

### Winner predication
```php
$team->pts * ($team->strength) / $allTeamsStrenghts * 100
```
To predict percentage of the winning team using their points and strengths.



## Design patterns & naming conventions
In this project I have used a service classes with methods for executing business logic so we can test these methods and use them in multiple controllers, I followed standard naming conventions for php and I had to replace the "Match" model with "Game" model as the "match" is a reserved keyword in php 8.

## Tests
I have made 7 tests in this project to make sure methods and features are working properly, These tests are : 
✓ generate week games  
✓ rand goals  
✓ add teams  
✓ remove teams  
✓ play all weeks games  
✓ play next week games  
✓ restart games  

## Technologies
PHP 8  
Laravel 8  
JS  
Vue  
Vuex  
Vuetify  


## Installation
```ssh
composer install 
npm install  
npm run prod  
php artisan migrate  
php artisan db:seed  
```
