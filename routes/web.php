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


	/* manage roles, start here */
	Route::get('/manage-roles',  [App\Http\Controllers\RoleController::class, 'index']);

	Route::get('/add-new-role',  [App\Http\Controllers\RoleController::class, 'create']);

	Route::post('/save-new-role', [App\Http\Controllers\RoleController::class, 'store'])->name('save-new-role');

	Route::get('/edit-role/{id}', [App\Http\Controllers\RoleController::class, 'edit']);

	Route::post('/update-role', [App\Http\Controllers\RoleController::class, 'update'])->name('update-role');
	/* manage roles, end here */


	/* manage company name, start here */
	Route::get('/manage-company-names',  [App\Http\Controllers\CompanyNameController::class, 'index']);

	Route::get('/add-new-company',  [App\Http\Controllers\CompanyNameController::class, 'create']);

	Route::post('/save-new-company', [App\Http\Controllers\CompanyNameController::class, 'store'])->name('save-new-company');

	Route::get('/edit-company-name/{id}', [App\Http\Controllers\CompanyNameController::class, 'edit']);

	Route::post('/update-company-name', [App\Http\Controllers\CompanyNameController::class, 'update'])->name('update-company-name');
	/* manage company name, end here */


	/* manage company location, start here */
	Route::get('/manage-company-locations',  [App\Http\Controllers\CompanyLocationController::class, 'index']);

	Route::get('/add-new-location',  [App\Http\Controllers\CompanyLocationController::class, 'create']);

	Route::post('/save-new-location', [App\Http\Controllers\CompanyLocationController::class, 'store'])->name('save-new-location');

	Route::get('/edit-company-location/{id}', [App\Http\Controllers\CompanyLocationController::class, 'edit']);

	Route::post('/update-company-location', [App\Http\Controllers\CompanyLocationController::class, 'update'])->name('update-company-location');
	/* manage company location, end here */


	/* manage job opening types, start here */
	Route::get('/manage-job-opening-types',  [App\Http\Controllers\JobOpeningTypesController::class, 'index']);

	Route::get('/add-new-job-opening-type',  [App\Http\Controllers\JobOpeningTypesController::class, 'create']);

	Route::post('/save-new-job-opening-type', [App\Http\Controllers\JobOpeningTypesController::class, 'store'])->name('save-new-job-opening-type');

	Route::get('/edit-job-opening-type/{id}', [App\Http\Controllers\JobOpeningTypesController::class, 'edit']);

	Route::post('/update-job-opening-type', [App\Http\Controllers\JobOpeningTypesController::class, 'update'])->name('update-job-opening-type');
	/* manage job opening types, end here */



	/* common route for manage staus and delete, start here */
	Route::post('/update-status', [App\Http\Controllers\StatusUpdateDeleteController::class, 'updateStatus']);

	Route::post('/delete-row-value', [App\Http\Controllers\StatusUpdateDeleteController::class, 'deleteRow']);
	/* common route for manage staus and delete, end here */


	/*Confirmation Process & MOM Email, start here*/
	Route::get('/confirmation-process-mom-email',  [App\Http\Controllers\UserController::class, 'index'])->middleware('isHRManagement');

	Route::get('/start-confirmation-process/{id}',  [App\Http\Controllers\UserController::class, 'startConfirmationEmployeeDetails'])->middleware('isHRManagement');

	Route::get('/interview-survey/{id}',  [App\Http\Controllers\UserInterviewFormController::class, 'interviewSurvey'])->middleware('isHRManagement');

	Route::get('/recruitment-survey/{id}',  [App\Http\Controllers\UserRecruitmentFormController::class, 'recruitmentSurvey'])->middleware('isHRManagement');

	Route::get('/ppt/{id}',  [App\Http\Controllers\UserController::class, 'ppt'])->middleware('isHRManagement');

	Route::get('/thankyou/{id}',  [App\Http\Controllers\UserController::class, 'thankyou'])->middleware('isHRManagement');
	/*Confirmation Process & MOM Email, end here*/


	/* ppt upload, start here*/
	Route::get('/ppt-upload', [App\Http\Controllers\UserController::class, 'pptUpload']);

	Route::post('/upload-ppt', [App\Http\Controllers\UserController::class, 'savePpt'])->name('upload-ppt');
	/* ppt upload, end here*/


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

