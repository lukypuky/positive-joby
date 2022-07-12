<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

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

Route::get('/kontakt', [PageController::class, 'getContact'])->name('getContact');
Route::get('/referencie', [PageController::class, 'getReference'])->name('getReference');
Route::post('/sendMail', [PageController::class, 'sendMail'])->name('sendMail');

Route::post('/jobs/search', [PageController::class,'searchJobs'])->name('searchJobs');
Route::post('/jobs/layout', [PageController::class,'getJobLayout'])->name('getJobLayout');
Route::post('/jobs/filter', [PageController::class,'getJobsFiltred'])->name('getJobFiltred');