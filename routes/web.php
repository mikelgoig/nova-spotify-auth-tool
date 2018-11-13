<?php

use Illuminate\Support\Facades\Route;
use Mgoigfer\SpotifyAuthTool\Http\Controllers\SpotifyAuthToolController;

/*
|--------------------------------------------------------------------------
| Tool Web Routes
|--------------------------------------------------------------------------
|
| Here is where you may register web routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

Route::get('/auth', SpotifyAuthToolController::class.'@auth');
