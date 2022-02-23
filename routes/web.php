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
// postではなくgetを使う & 関数名が異なる question=>x question=>○ 
Route::get("/questions",[UserController::class,"questions"])->name("user.questions");
Route::post("/store",[UserController::class,"store"])->name("user.store");
// Route::get('/question', function () {
//     return view ('question');
//  });

 Route::get('/answers', function () {
    return view ('answers');
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

Route::post('/question',function(){

    // バリデーションのルール定義
    $rules = array(
      'name' => 'required'
    );
  
    // バリデーション設定
    $validation = Validator::make(Input::all(), $rules);
  
    // バリデーションNG
    if($validation->fails()) {
      // リダイレクトしてエラーメッセージを表示 withInputでフォームの内容を維持することが可能
      return Redirect::to('/question')
        ->withInput()
        ->withErrors($validation);
    } else {
      // 同じ名前が既に登録されているか確認
      $allanswers = allanswers::where('name', '=', Input::get('name'))
        ->first();
  
      // 登録済みの場合はリダイレクト
      if($allanswers) {
        return Redirect::to('/questions')
          ->withInput()
          ->with('duplicate', Input::get('name').'は登録されています');
      } else {
        // 未登録の場合はデータベースに追加
        allanswers::create(array(
          'name' => Input::get('name'),
        ));
          
        // 登録後にリダイレクト	
        return Redirect::to('/question')
          ->with('success', '登録されました');
      }
    }
  });