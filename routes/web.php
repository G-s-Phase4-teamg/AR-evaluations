<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

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
//clientController
Route::get("/projects", [ClientController::class, "projects"])->name("client.projects");
Route::get("/survey", [ClientController::class, "survey"])->name("client.survey");
Route::get("/instagram", [ClientController::class, "instagram"])->name("client.instagram");
Route::get("/api_test", [ClientController::class, "api_test"])->name("client.api_test");
Route::get("/analyze", [ClientController::class, "analyze"])->name("client.analyze");

//userController


//welcome
Route::get('/', function () {
    return view('welcome');
});

//login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
