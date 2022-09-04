<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminEventsController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\Auth\VerificationController;


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
Route::redirect('/pt', '/pt/home');
Route::redirect('/en', '/en/home');
// Route::redirect('/', '/pt');


Route::group(['prefix' => '{language?}'], function () {
	Route::get('/', function () {
		return view('welcome');
	});

	Route::get('/home', [HomeController::class, 'index'])->name('home');
	Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');
	Route::get('/roadMap/{personality?}', [RoadMapController::class, 'index'])->name('roadMap');
	Route::get('/contact', [ContactController::class, 'index'])->name('contact');

	// sending and storing data of the quiz answered by the user logged in or not
	Route::post('/send', [QuizController::class, 'store'])->name('quiz.store');
	Route::get('/byCookie', [RoadMapController::class, 'calculatePersonalityByCookies'])->name('byCookie');

	// user registration routes
	Route::get('/signup', [UserController::class, 'signup'])->name('signup');
	Route::post('/register', [UserController::class, 'store'])->name('user.store');

	// user authentication routes
	Route::get('/login', [LoginController::class, 'login'])->name('login');
	Route::post('/login', [LoginController::class, 'validateLogin'])->name('validate.login');

	// user email confirmation routes
	Route::get('/emailConfirmation/{key?}', [UserController::class, 'emailConfirmation'])->name('email.confirmation');
	Route::get('/emailStyle', [LoginController::class, 'emailStyle'])->name('email.style');
	Route::post('/sendEmail', [ContactController::class, 'sendEmail'])->name('contact.email');

	// user password recovery routes
	Route::get('/recoverPassword', [LoginController::class, 'recoverPassword'])->name('recover.password');
	Route::post('/passwordRequest', [LoginController::class, 'passwordRequest'])->name('password.request');
	Route::get('/resetPassword/{key?}', [LoginController::class, 'resetPassword'])->name('reset.password');
	Route::post('/updatePassword', [LoginController::class, 'updatePassword'])->name('update.password');

	// protected routes, only authenticated users
	Route::group(['middleware' => ['auth']], function () {
		// main routes
		Route::get('/event', [EventController::class, 'index'])->name('event');
		Route::get('/feed', [FeedController::class, 'index'])->name('feed');
		Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
		Route::get('/user', [UserController::class, 'index'])->name('user');
		Route::get('/touristSpot/{id?}', [TouristSpotController::class, 'show'])->name('touristSpot.show');
		Route::get('/user/{id?}', [UserController::class, 'show'])->name('user.show');

		// admin routes 
		Route::get('/adminEvents', [AdminEventsController::class, 'index'])->name('adminEvents');
		Route::get('/adminReport', [AdminReportController::class, 'index'])->name('adminReport');
		Route::post('/addEvent', [AdminEventsController::class, 'store'])->name('adminEvents.store');

		// upload publications routes
		Route::post('/addPost', [PublicationController::class, 'store'])->name('publication.store');
		Route::post('/cropPost', [PublicationController::class, 'crop'])->name('publication.crop');
		Route::post('/report', [PublicationController::class, 'report'])->name('publication.report');

        // edit publications
		Route::post('/editPublication/{id?}', [PublicationController::class, 'update'])->name('update.publication');
		Route::get('/deletePublication/{id?}', [PublicationController::class, 'delete'])->name('delete.publication');

		// edit profile
		Route::get('/checkUsernameAvailability', [UserController::class, 'checkUsernameAvailability'])->name('username.availability');
		Route::post('/updateProfile', [UserController::class, 'update'])->name('update.profile');

		// logout route
		Route::get('/logout', function () {
			Auth::logout();
			return redirect()->route('login', app()->getLocale());
		})->name('logout');
	});

	// protected routes, only authenticated admins
	Route::group(['middleware' => ['authAdmin']], function () {
        // admin routes 
        Route::get('/adminEvents', [AdminEventsController::class, 'index'])->name('adminEvents');
        Route::get('/adminReport', [AdminReportController::class, 'index'])->name('adminReport');
        Route::post('/addEvent', [AdminEventsController::class, 'store'])->name('adminEvents.store');
        
        // report management
        Route::get('/acceptComplaint', [AdminReportController::class, 'acceptComplaint'])->name('accept.complaint');
        Route::get('/refuseComplaint', [AdminReportController::class, 'refuseComplaint'])->name('refuse.complaint');

    });
});
