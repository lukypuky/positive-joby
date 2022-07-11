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

Route::get('/', [PageController::class, 'getIndex'])->name('getIndex');
Route::get('/index', [PageController::class, 'getIndex'])->name('getIndex');

Route::get('/{slug}', [PageController::class, 'getJob'])->name('getJob');

Route::get('/kontakt', [PageController::class, 'getContact']);
Route::get('/referencie', [PageController::class, 'getReference']);

Route::post('/jobs/search', [PageController::class,'searchJobs'])->name('searchJobs');
Route::post('/jobs/layout', [PageController::class,'getJobLayout'])->name('getJobLayout');
Route::post('/jobs/filter', [PageController::class,'getJobsFiltred'])->name('getJobFiltred');