<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Models\customers;

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
Route::post("/survey", [ClientController::class, "survey"])->name("client.survey");
Route::post("/instagram", [ClientController::class, "instagram"])->name("client.instagram");
Route::get("/api_test", [ClientController::class, "api_test"])->name("client.api_test");

//userController
Route::post("/question",[UserController::class,"question"])->name("user.question");
Route::get('/question', function () {
    return view ('question');
 });

//welcome
Route::get('/', function () {
    return view('welcome');
});

//login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';


//ar
Route::get('/ar', function () {
    return view ('ar');
 });
