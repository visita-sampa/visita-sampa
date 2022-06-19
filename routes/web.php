<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\QuizController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\RoadMapController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TouristSpotController;
use App\Http\Controllers\PublicationController;

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

Route::redirect('/', '/pt/home');
// Route::redirect('/', '/pt');


Route::group(['prefix' => '{language}'], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');
    Route::get('/event', [EventController::class, 'index'])->name('event');
    Route::get('/feed', [FeedController::class, 'index'])->name('feed');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
    Route::get('/roadMap', [RoadMapController::class, 'index'])->name('roadMap');
    Route::get('/user', [UserController::class, 'index'])->name('user');

    Route::get('/touristSpot/{id?}', [TouristSpotController::class, 'show'])->name('touristSpot.show');

    Route::post('/send', [QuizController::class, 'store'])->name('quiz.store');
    
    // user registration routes
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register', [UserController::class, 'store'])->name('user.store');
    
    // user authentication routes
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'validateLogin'])->name('validate.login');
    
    // Route::post('/addEvent', [EventController::class, 'store'])->name('event.store');
    // Route::post('/addTouristSpot', [TouristSpotController::class, 'store'])->name('touristSpot.store');

    Route::group(['middleware' => ['auth']], function () {
        // upload publications routes
        Route::post('/addPost', [PublicationController::class, 'store'])->name('publication.store');
        Route::post('/cropPost', [PublicationController::class, 'crop'])->name('publication.crop');

        // upload profile pic route
        Route::post('/crop', [UserController::class, 'crop'])->name('user.crop');

        // logout route
        Route::get('/logout', function () {
            Auth::logout();
            return redirect()->route('login', app()->getLocale());
        })->name('logout');
    });
});
