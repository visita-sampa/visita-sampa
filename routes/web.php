<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\QuizController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\RoadMapController;

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

Route::redirect('/', '/pt/quiz');


Route::group(['prefix' => '{language}'], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    // Auth::routes();

    Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');
    Route::get('/event', [EventController::class, 'index'])->name('event');
    Route::get('/feed', [FeedController::class, 'index'])->name('feed');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
    Route::get('/roadMap', [RoadMapController::class, 'index'])->name('roadMap');

    // Route::get('/quiz/send', [QuizController::class, 'create'])->name('quiz.send');
    Route::post('/send', [QuizController::class, 'store'])->name('quiz.store');

    // Route::get('listar', function(){
    //     try{
    //       // vamos tentar obter o PDO da conexão
    //       $pdo = DB::connection()->getPdo();

    //       return "Conectado com sucesso à base de dados: " .
    //         DB::connection()->getDatabaseName();    
    //     }
    //     catch(\Exception $exc){
    //       return "Erro ao conectar: " . $exc;
    //     }  
    //   }); 
});
