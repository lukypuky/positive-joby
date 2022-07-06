<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PageController::class, 'getIndex']);
Route::get('/index', [PageController::class, 'getIndex']);

Route::get('/tile', [PageController::class, 'getTile']);

Route::post('/jobs/search', [PageController::class,'searchJobs'])->name('searchJobs');
Route::post('/jobs/tiles', [PageController::class,'getJobTiles'])->name('getJobTiles');
Route::post('/jobs/rows', [PageController::class,'getJobRows'])->name('getJobRows');
