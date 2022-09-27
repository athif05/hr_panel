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
    
	Route::get('/home/filter',  [App\Http\Controllers\HomeController::class, 'homeDashboardFilter'])->name('home.filter');

    /*show interview survey from*/
	Route::get('/interview-survey', [App\Http\Controllers\UserInterviewFormController::class, 'index']);

	Route::post('/get-hr-name-ajax-for-interview-survey-form', [App\Http\Controllers\UserInterviewFormController::class, 'getHrNameAjax']);


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


	/*hiring-survey form, start here*/
	Route::get('/hiring-survey', [App\Http\Controllers\HiringSurveyController::class, 'index']);

	Route::post('/save-hiring-survey', [App\Http\Controllers\HiringSurveyController::class, 'store'])->name('save-hiring-survey');

	Route::get('/hiring-survey-edit/{id}', [App\Http\Controllers\HiringSurveyController::class, 'edit']);

	Route::post('/update-hiring-survey', [App\Http\Controllers\HiringSurveyController::class, 'update'])->name('update-hiring-survey');
	/*hiring-survey form, end here*/


	/*hiring-survey form, start here*/
	Route::get('/training-survey', [App\Http\Controllers\TrainingSurveyController::class, 'index']);

	Route::post('/save-training-survey', [App\Http\Controllers\TrainingSurveyController::class, 'store'])->name('save-training-survey');

	Route::get('/training-survey-edit/{id}', [App\Http\Controllers\TrainingSurveyController::class, 'edit']);

	Route::post('/update-training-survey', [App\Http\Controllers\TrainingSurveyController::class, 'update'])->name('update-training-survey');

	Route::post('/get-all-trainers-name-ajax', [App\Http\Controllers\TrainingSurveyController::class, 'getTrainerAjax']);
	/*hiring-survey form, end here*/


	/*member check-in form, start here*/
	Route::get('/member-check-in-form', [App\Http\Controllers\Days45CheckInMemberController::class, 'index']);

	Route::post('/save-member-check-in-form', [App\Http\Controllers\Days45CheckInMemberController::class, 'store'])->name('save-member-check-in-form');

	Route::get('/member-check-in-form-edit/{id}', [App\Http\Controllers\Days45CheckInMemberController::class, 'edit']);

	Route::post('/update-member-check-in-form', [App\Http\Controllers\Days45CheckInMemberController::class, 'update'])->name('update-member-check-in-form');

	Route::post('/get-reporting-manager-name-ajax', [App\Http\Controllers\Days45CheckInMemberController::class, 'getReportingManagerNameAjax']);
	/*member check-in form, end here*/
	

	Route::get('/confirmation-process-initation-form', function () {
	    return view('confirmation-process-initation-form');
	});


	/*fresh eye journal form, start here*/
	Route::get('/fresh-eye-journal-form', [App\Http\Controllers\FreshEyeJournalController::class, 'index']);

	Route::post('/save-fresh-eye-journal-form', [App\Http\Controllers\FreshEyeJournalController::class, 'store'])->name('save-fresh-eye-journal-form');

	Route::post('/get-company-name-fresh-eye-ajax', [App\Http\Controllers\FreshEyeJournalController::class, 'getCompanyNameAjax']);

	Route::post('/get-hod-name-ajax', [App\Http\Controllers\FreshEyeJournalController::class, 'getHODNameAjax']);

	Route::get('/fresh-eye-journal-form-edit/{id}', [App\Http\Controllers\FreshEyeJournalController::class, 'edit']);

	Route::post('/update-fresh-eye-journal-form', [App\Http\Controllers\FreshEyeJournalController::class, 'update'])->name('update-fresh-eye-journal-form');
	/*fresh eye journal form, start here*/

	

	/* manage departments, start here */
	Route::get('/manage-departments',  [App\Http\Controllers\DepartmentController::class, 'index'])->middleware('isManagement');

	Route::get('/add-new-department',  [App\Http\Controllers\DepartmentController::class, 'create'])->middleware('isManagement');

	Route::post('/save-new-department', [App\Http\Controllers\DepartmentController::class, 'store'])->name('save-new-department');

	Route::get('/edit-department/{id}', [App\Http\Controllers\DepartmentController::class, 'edit'])->middleware('isManagement');

	Route::post('/update-department', [App\Http\Controllers\DepartmentController::class, 'update'])->name('update-department');
	/* manage departments, end here */



	/* manage departments, start here */
	Route::get('/manage-designations',  [App\Http\Controllers\DesignationController::class, 'index'])->middleware('isManagement');

	Route::get('/add-new-designation',  [App\Http\Controllers\DesignationController::class, 'create'])->middleware('isManagement');

	Route::post('/save-new-designation', [App\Http\Controllers\DesignationController::class, 'store'])->name('save-new-designation');

	Route::get('/edit-designation/{id}', [App\Http\Controllers\DesignationController::class, 'edit'])->middleware('isManagement');

	Route::post('/update-designation', [App\Http\Controllers\DesignationController::class, 'update'])->name('update-designation');
	/* manage departments, end here */



	/* manage roles, start here */
	Route::get('/manage-roles',  [App\Http\Controllers\RoleController::class, 'index'])->middleware('isManagement');

	Route::get('/add-new-role',  [App\Http\Controllers\RoleController::class, 'create'])->middleware('isManagement');

	Route::post('/save-new-role', [App\Http\Controllers\RoleController::class, 'store'])->name('save-new-role');

	Route::get('/edit-role/{id}', [App\Http\Controllers\RoleController::class, 'edit'])->middleware('isManagement');

	Route::post('/update-role', [App\Http\Controllers\RoleController::class, 'update'])->name('update-role');
	/* manage roles, end here */


	/* manage company name, start here */
	Route::get('/manage-company-names',  [App\Http\Controllers\CompanyNameController::class, 'index'])->middleware('isManagement');

	Route::get('/add-new-company',  [App\Http\Controllers\CompanyNameController::class, 'create'])->middleware('isManagement');

	Route::post('/save-new-company', [App\Http\Controllers\CompanyNameController::class, 'store'])->name('save-new-company');

	Route::get('/edit-company-name/{id}', [App\Http\Controllers\CompanyNameController::class, 'edit'])->middleware('isManagement');

	Route::post('/update-company-name', [App\Http\Controllers\CompanyNameController::class, 'update'])->name('update-company-name');
	/* manage company name, end here */


	/* manage company location, start here */
	Route::get('/manage-company-locations',  [App\Http\Controllers\CompanyLocationController::class, 'index'])->middleware('isManagement');

	Route::get('/add-new-location',  [App\Http\Controllers\CompanyLocationController::class, 'create'])->middleware('isManagement');

	Route::post('/save-new-location', [App\Http\Controllers\CompanyLocationController::class, 'store'])->name('save-new-location');

	Route::get('/edit-company-location/{id}', [App\Http\Controllers\CompanyLocationController::class, 'edit'])->middleware('isManagement');

	Route::post('/update-company-location', [App\Http\Controllers\CompanyLocationController::class, 'update'])->name('update-company-location');
	/* manage company location, end here */


	/* manage job opening types, start here */
	Route::get('/manage-job-opening-types',  [App\Http\Controllers\JobOpeningTypesController::class, 'index'])->middleware('isManagement');

	Route::get('/add-new-job-opening-type',  [App\Http\Controllers\JobOpeningTypesController::class, 'create'])->middleware('isManagement');

	Route::post('/save-new-job-opening-type', [App\Http\Controllers\JobOpeningTypesController::class, 'store'])->name('save-new-job-opening-type');

	Route::get('/edit-job-opening-type/{id}', [App\Http\Controllers\JobOpeningTypesController::class, 'edit'])->middleware('isManagement');

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

	Route::get('/member-check-in-from/{id}',  [App\Http\Controllers\Days45CheckInMemberController::class, 'memberCheckIn'])->middleware('isHRManagement');

	Route::get('/fresh-eye-journal/{id}',  [App\Http\Controllers\FreshEyeJournalController::class, 'freshEyeJournal'])->middleware('isHRManagement');

	Route::get('/ppt/{id}',  [App\Http\Controllers\UserController::class, 'ppt'])->middleware('isHRManagement');

	Route::get('/manager-check-in-from/{id}',  [App\Http\Controllers\FreshEyeJournalController::class, 'managerCheckInFrom'])->middleware('isHRManagement');

	Route::get('/manager-confirmation-feedback-form/{id}',  [App\Http\Controllers\ConfirmationFeedbackFormController::class, 'managerConfirmationFeedbackForm'])->middleware('isHRManagement');

	Route::get('/thankyou/{id}',  [App\Http\Controllers\UserController::class, 'thankyou'])->middleware('isHRManagement');

	Route::get('/mom-email-view/{id}',  [App\Http\Controllers\UserController::class, 'momEmailView'])->middleware('isHRManagement');

	Route::get('/confirmation-process-mom-email/filter',  [App\Http\Controllers\UserController::class, 'confirmationProcessMomEmailFilter'])->name('confirmation-process-mom-email.filter')->middleware('isHRManagement');
	/*Confirmation Process & MOM Email, end here*/


	/*hr generate email, start here*/
	Route::get('/hr-generate-emails',  [App\Http\Controllers\UserController::class, 'hrGenerateEmails'])->middleware('isHRManagement');

	Route::get('/generate-email-form/{id}',  [App\Http\Controllers\ConfirmationGenerateEmailController::class, 'index'])->middleware('isHRManagement');

	Route::post('/save-generate-email-form', [App\Http\Controllers\ConfirmationGenerateEmailController::class, 'store'])->name('save-generate-email-form');

	Route::get('/generate-email-form-edit/{id}', [App\Http\Controllers\ConfirmationGenerateEmailController::class, 'edit']);

	Route::post('/update-generate-email-form', [App\Http\Controllers\ConfirmationGenerateEmailController::class, 'update'])->name('update-generate-email-form');

	Route::post('/send-generate-confirmation-email', [App\Http\Controllers\ConfirmationGenerateEmailController::class, 'sendGenerateConfirmationEmail']);


	Route::post('/send-confirmation-mom-email-view', [App\Http\Controllers\ConfirmationGenerateEmailController::class, 'sendGenerateMomEmailView']);


	Route::get('/hr-generate-emails/filter',  [App\Http\Controllers\UserController::class, 'hrGenerateEmailsFilter'])->name('hr-generate-emails.filter')->middleware('isHRManagement');

	Route::get('/send-generate-mom-email-view-test', [App\Http\Controllers\ConfirmationGenerateEmailController::class, 'sendGenerateMOMEmailTest']);
	//Route::get('/send-generate-confirmation-email-test', [App\Http\Controllers\ConfirmationGenerateEmailController::class, 'sendGenerateConfirmationEmailTest']);
	/*hr generate email, end here*/


	/*hr mom, start here*/
	Route::get('/hr-mom',  [App\Http\Controllers\UserController::class, 'hrMom'])->middleware('isHRManagement');

	Route::get('/hr-mom/filter',  [App\Http\Controllers\UserController::class, 'hrMomFilter'])->name('hr-mom.filter')->middleware('isHRManagement');
	/*hr mom, end here*/


	/* ppt upload, start here*/
	Route::get('/ppt-upload', [App\Http\Controllers\UserController::class, 'pptUpload']);

	Route::post('/upload-ppt', [App\Http\Controllers\UserController::class, 'savePpt'])->name('upload-ppt');
	/* ppt upload, end here*/


	/*change password, start here*/
	Route::get('/change-password',[App\Http\Controllers\UserController::class, 'changePassword']);

	Route::post('/update-password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('update-password');
	/*change password, end here*/


	/*my profile, start here*/
	Route::get('/my-profile',[App\Http\Controllers\UserController::class, 'myProfile']);

	Route::post('/upload-profile-image', [App\Http\Controllers\UserController::class, 'uploadProfileImage'])->name('upload-profile-image');
	/*my profile, end here*/


	/*manager check-in form, manager confirmation feedback and mom, start here*/
	Route::get('/manager-check-in-form', [App\Http\Controllers\UserController::class, 'showProbationMemberForManagerCheckIn'])->middleware('isManager');

	Route::get('/manager-check-in-form/{id}', function () {
	    return view('manager-check-in-form');
	})->middleware('isManager');
	/*manager check-in form, manager confirmation feedback and mom, end here*/


	/*manager confirmation feedback form, start here*/
	Route::get('/confirmation-feedback-form', [App\Http\Controllers\UserController::class, 'showProbationMemberForManagerConfirmationFeedback'])->middleware('isManager');

	Route::get('/confirmation-feedback-form/{id}', [App\Http\Controllers\UserController::class, 'confirmationFeedbackForm'])->middleware('isManager');

	Route::post('/save-confirmation-feedback-form', [App\Http\Controllers\ConfirmationFeedbackFormController::class, 'store'])->name('save-confirmation-feedback-form');

	Route::get('/confirmation-feedback-form-edit/{user_id}/{id}', [App\Http\Controllers\ConfirmationFeedbackFormController::class, 'edit'])->middleware('isManager');

	Route::post('/update-confirmation-feedback-form', [App\Http\Controllers\ConfirmationFeedbackFormController::class, 'update'])->name('update-confirmation-feedback-form');

	Route::get('/confirmation-feedback-form-show/{user_id}/{id}', [App\Http\Controllers\ConfirmationFeedbackFormController::class, 'index'])->middleware('isManager');
	/*manager confirmation feedback form, end here*/


	/*manager mom form, start here*/
	Route::get('/manager-mom', [App\Http\Controllers\UserController::class, 'showProbationMemberForManagerMOM'])->middleware('isManager');

	Route::get('/manager-mom/{id}', [App\Http\Controllers\UserController::class, 'managerMOMForm'])->middleware('isManagerHrandHrHead');

	Route::post('/save-manager-mom', [App\Http\Controllers\ConfirmationMomController::class, 'store'])->name('save-manager-mom');

	Route::get('/manager-mom-form-edit/{user_id}/{id}', [App\Http\Controllers\ConfirmationMomController::class, 'edit'])->middleware('isManagerHrandHrHead');

	Route::post('/update-manager-mom', [App\Http\Controllers\ConfirmationMomController::class, 'update'])->name('update-manager-mom');

	Route::get('/manager-mom-form-show/{user_id}/{id}', [App\Http\Controllers\ConfirmationMomController::class, 'index'])->middleware('isManagerHrandHrHead');
	/*manager mom form, end here*/


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

