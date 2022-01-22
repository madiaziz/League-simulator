<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\TeamController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/weeks/current', [GameController::class, 'getCurrentWeek'])->name('weeks.current');
Route::put('/weeks/{week}/next', [GameController::class, 'goToNextWeek'])->name('weeks.next');
Route::put('/weeks/{week}/last', [GameController::class, 'goToLastWeek'])->name('weeks.last');
Route::put('/weeks/restart', [GameController::class, 'restart'])->name('weeks.restart');

Route::put('/teams/add', [TeamController::class, 'addTeams'])->name('teams.add');
Route::put('/teams/remove', [TeamController::class, 'removeTeams'])->name('teams.remove');

