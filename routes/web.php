<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


/*pages are access only when user is loggedin first option, start here*/
Route::group(['middleware' => ['auth']], function() {
    

    /*show interview survey from*/
	Route::get('/interview-survey', [App\Http\Controllers\UserInterviewFormController::class, 'index']);


	/*save interview survey form into database*/
	Route::post('/save-interview-survey-form', [App\Http\Controllers\UserInterviewFormController::class, 'store'])->name('save-interview-survey-form');


	/* edit interview form */
	Route::get('/interview-survey-edit/{id}', [App\Http\Controllers\UserInterviewFormController::class, 'edit']);


	/*update interview survey form into database*/
	Route::post('/update-interview-survey-form', [App\Http\Controllers\UserInterviewFormController::class, 'update'])->name('update-interview-survey-form');

	/*save interview survey form into database*/
	Route::post('/save-recruitment-survey-form', [App\Http\Controllers\UserRecruitmentFormController::class, 'store'])->name('save-recruitment-survey-form');


	/* edit interview form */
	Route::get('/recruitment-survey-edit/{id}', [App\Http\Controllers\UserRecruitmentFormController::class, 'edit']);


	/*update interview survey form into database*/
	Route::post('/update-recruitment-survey-form', [App\Http\Controllers\UserRecruitmentFormController::class, 'update'])->name('update-recruitment-survey-form');


	/*mail notification routes*/
	Route::get('/member-check-in-form', function () {
	    return view('member-check-in-form');
	});

	Route::get('/manager-check-in-form/{id}', function () {
	    return view('manager-check-in-form');
	})->middleware('isManager');

	Route::get('/confirmation-process-initation-form', function () {
	    return view('confirmation-process-initation-form');
	});

	Route::get('/fresh-eye-journal-form', function () {
	    return view('fresh-eye-journal-form');
	});

	Route::get('/confirmation-feedback-form/{id}', function () {
	    return view('confirmation-feedback-form');
	})->middleware('isManager');


	Route::get('/manage-roles',  [App\Http\Controllers\RoleController::class, 'index']);

	Route::get('/add-new-role',  [App\Http\Controllers\RoleController::class, 'create']);

	Route::post('/save-new-role', [App\Http\Controllers\RoleController::class, 'store'])->name('save-new-role');

	Route::get('/edit-role/{id}', [App\Http\Controllers\RoleController::class, 'edit']);

	Route::post('/update-role', [App\Http\Controllers\RoleController::class, 'update'])->name('update-role');

	Route::post('/update-role-status', [App\Http\Controllers\RoleController::class, 'updateStatus']);

	Route::post('/delete-role', [App\Http\Controllers\RoleController::class, 'deleteRole']);

});
/*pages are access only when user is loggedin first option, end here*/


/*pages are access only when user is loggedin second option, start here*/
Route::get('/recruitment-survey', [App\Http\Controllers\UserRecruitmentFormController::class, 'index'])->middleware('auth');
/*pages are access only when user is loggedin second option, end here*/


/*thank you page*/
Route::get('/thank-you', function(){
	return view('thank-you');
});



/*cron job url, start here*/
Route::get('/candidate-survey-form-notification', [App\Http\Controllers\SurveyNotificationCron::class, 'sendCron']);
/*cron job url, end here*/

