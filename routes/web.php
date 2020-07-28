<?php
// composer update
// php artisan migrate
// php artisan db:seed
// composer dump-autoload

// Routes cachées:
// Avocats stagiaires/admin => /login
// Avocats 1ère heure 		=> /lawyer/login
// Police 					=> /avocats-de-la-premiere-heure

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

// Public routes
Route::group(['middleware' => ['web']], function() {
	// Auth::routes();

	Route::get('/', array('as' => 'index', 'uses' => 'Front\\HomeController@index'));
	Route::get('/home', array('as' => 'home', 'uses' => 'Front\\HomeController@index'));
	Route::get('formulaire-contact', array('as' => 'formulaire_contact', 'uses' => 'Front\\FormulaireContactsController@index'));
	Route::post('formulaire-contact', array('as' => 'formulaire_contact', 'uses' => 'Front\\FormulaireContactsController@store'));
	Route::post('/addToDownloadCount', array('as' => 'addToDownloadCount', 'uses' => 'Front\\HomeController@addToDownloadCount'));

	// Account confirmation
	Route::get('confirmation/resend', 'Auth\Lawyer\LawyerRegisterController@resend');
	Route::get('confirmation/{id}/{token}', 'Auth\Lawyer\LawyerRegisterController@confirm');

	// Trainees
	// Route::get('/avocats-stagiaires/{page}', 'HomeController@trainees');
	// Route::get('avocats-stagiaires/avant-le-stage', array('as' => 'trainee.beforeStage', 'uses' => 'Front\\TraineeController@beforeStage'));
	// Route::get('avocats-stagiaires/pendant-le-stage', array('as' => 'trainee.duringStage', 'uses' => 'Front\\TraineeController@duringStage'));
	// Route::get('avocats-stagiaires/examens-du-barreau', array('as' => 'trainee.barExam', 'uses' => 'Front\\TraineeController@barExam'));
});

// Members guest routes
Route::group(['middleware' => ['guest:member']], function() {
	// Member login and registration routes
	Route::get('/membre/login', array('as' => 'member.login', 'uses' => 'Auth\Member\MemberLoginController@showLoginForm'));
	Route::post('/membre/login', array('as' => 'member.login.submit', 'uses' => 'Auth\Member\MemberLoginController@login'));
	Route::get('/membre/enregistrement', array('as' => 'member.register', 'uses' => 'Auth\Member\MemberRegisterController@showRegisterForm'));
	Route::post('/membre/enregistrement', array('as' => 'member.register.submit', 'uses' => 'Auth\Member\MemberRegisterController@register'));
	
	// Member password reset routes
	Route::post('/member/password/email', array('as' => 'member.password.email', 'uses' => 'Auth\Member\MemberForgotPasswordController@sendResetLinkEmail'));
	Route::get('/member/password/reset', array('as' => 'member.password.request', 'uses' => 'Auth\Member\MemberForgotPasswordController@showLinkRequestForm'));
	Route::post('/member/password/reset', array('as' => 'member.password.reset.email', 'uses' => 'Auth\Member\MemberResetPasswordController@reset'));
	Route::get('/member/password/reset/{token}', array('as' => 'member.password.reset', 'uses' => 'Auth\Member\MemberResetPasswordController@showResetForm'));
});

// Members protected routes
Route::group(['middleware' => ['auth:member']], function() {
	Route::resource('membre/profil', 'Auth\\Member\\ProfileController', ['only' => ['show', 'edit', 'update'], 'names' => ['show' => 'member.profile.show', 'edit' => 'member.profile.edit', 'update' => 'member.profile.update']]);
	Route::post('membre/profil/{profile}/edit', array('as' => 'member.profile.changePassword', 'uses' => 'Auth\\Member\\ProfileController@changePassword'));
	
	// Member logout
	Route::get('/member/logout', array('as' => 'member.logout', 'uses' => 'Auth\Member\MemberLoginController@logout'));
});

// Lawyers guest routes
Route::group(['middleware' => ['guest:lawyer']], function() {
	// Lawyer login and registration routes
	Route::get('/avocat/login', array('as' => 'lawyer.login', 'uses' => 'Auth\Lawyer\LawyerLoginController@showLoginForm'));
	Route::post('/avocat/login', array('as' => 'lawyer.login.submit', 'uses' => 'Auth\Lawyer\LawyerLoginController@login'));
	Route::get('/avocat/enregistrement', array('as' => 'lawyer.register', 'uses' => 'Auth\Lawyer\LawyerRegisterController@showRegisterForm'));
	Route::post('/avocat/enregistrement', array('as' => 'lawyer.register.submit', 'uses' => 'Auth\Lawyer\LawyerRegisterController@register'));

	// Lawyer registration verification
	Route::get('/avocat/verification/{token}', 'Auth\Lawyer\LawyerRegisterController@verifyLawyer');
	Route::get('/avocat/resend', 'Auth\Lawyer\LawyerRegisterController@resendVerificationEmail');

	// Lawyer password reset routes
	Route::post('/lawyer/password/email', array('as' => 'lawyer.password.email', 'uses' => 'Auth\Lawyer\LawyerForgotPasswordController@sendResetLinkEmail'));
	Route::get('/lawyer/password/reset', array('as' => 'lawyer.password.request', 'uses' => 'Auth\Lawyer\LawyerForgotPasswordController@showLinkRequestForm'));
	Route::post('/lawyer/password/reset', array('as' => 'lawyer.password.reset.email', 'uses' => 'Auth\Lawyer\LawyerResetPasswordController@reset'));
	Route::get('/lawyer/password/reset/{token}', array('as' => 'lawyer.password.reset', 'uses' => 'Auth\Lawyer\LawyerResetPasswordController@showResetForm'));
});

// Lawyers protected routes
Route::group(['middleware' => ['auth:lawyer']], function() {
// Route::group(['middleware' => ["auth::guard('lawyer')"]], function() {
	Route::resource('permanences', 'Front\\PermanencesController', ['as' => 'lawyer']);
	Route::post('/lawyer/{id}/changePassword', array('as' => 'lawyer.changePassword', 'uses' => 'Front\\LawyerController@changePassword'));
	Route::post('/lawyer/{id}/addLawyerOffice}', array('as' => 'lawyer.addNewLawyerOffice', 'uses' => 'Front\\LawyerController@addNewLawyerOffice'));
	Route::post('/lawyer/{id}/updateLawyerOffice}', array('as' => 'lawyer.updateLawyerOffice', 'uses' => 'Front\\LawyerController@updateLawyerOffice'));
	Route::resource('avocat', 'Front\\LawyerController', ['only' => ['index', 'edit', 'update', 'destroy'], 'names' => ['index' => 'lawyer.index', 'edit' => 'lawyer.edit', 'update' => 'lawyer.update', 'destroy' => 'lawyer.destroy']]);
	Route::post('/lawyer/{id}/edit', array('as' => 'lawyer.getLawyerOfficeData', 'uses' => 'Front\\LawyerController@getLawyerOfficeData'));
	// Route::resource('avocat', 'Front\\LawyerController', ['only' => ['index', 'update', 'destroy'], 'names' => ['index' => 'lawyer.index', 'update' => 'lawyer.update', 'destroy' => 'lawyer.destroy']]);
	// Route::get('/avocat/{id}/edit/', array('as' => 'lawyer.edit', 'uses' => 'Front\\LawyerController@edit'));
	// Route::get('conditions', array('as' => 'lawyer.permanences.conditions', 'uses' => 'Front\\PermanencesController@conditions'));
	Route::post('back/formulaire-question', array('as' => 'lawyer.formulaire.question', 'uses' => 'Front\\LawyerController@submitQuestion'));

	// Permanences
	Route::get('avocats-de-la-premiere-heure', array('as' => 'lawyer.availability', 'uses' => 'Front\\LawyerController@lawyerAvailability'));

	// Lawyer logout route
	Route::get('/lawyer/logout', array('as' => 'lawyer.logout', 'uses' => 'Auth\Lawyer\LawyerLoginController@logout'));
});

// Members protected routes
Route::group(['middleware' => ['auth']], function() {
	
});

// Only active members can access protected documents
// Route::group(['middleware' => ['auth', 'is_active']], function() {
Route::group(['middleware' => ['auth:member', 'is_active']], function() {
	Route::get('/fichiers-en-partage', array('as' => 'member.files', 'uses' => 'Front\\HomeController@files'));
});

// Admin routes
Route::group(['middleware' => ['auth:member', 'is_active', 'role:Admin'], 'as' => 'back.'], function() {
	Route::get('back/index', array('as' => 'index', 'uses' => 'Back\\BackController@index'));
	Route::resource('back/users', 'Back\\UsersController');
	// Route::resource('back/pages', 'Back\\PagesController');
	Route::resource('back/roles', 'Back\\RolesController');
	Route::resource('back/permissions', 'Back\\PermissionsController');
	Route::resource('back/tasks', 'Back\\TasksController');

	Route::resource('back/formulaire-contacts', 'Back\\FormulaireContactsController', ['only' => ['index', 'show', 'destroy']]);
	Route::post('back/formulaire-contacts', array('as' => 'contacts.changeStatus', 'uses' => 'Back\\FormulaireContactsController@changeStatus'));

	// Route::get('back/profile', array('as' => 'profile', 'uses' => 'Back\\UsersController@profile'));
	Route::resource('back/files', 'Back\\FilesController', ['only' => ['index']]);
	// Route::post('back/getAllFiles', array('as' => 'getAllFiles', 'uses' => 'Back\\FilesController@getAllFiles'));
	Route::post('back/activate-user', array('as' => 'users.changeStatus', 'uses' => 'Back\\UsersController@changeStatus'));
	Route::get('back/email-user/{id}', array('as' => 'users.showEmail', 'uses' => 'Back\\UsersController@showEmail'));
	Route::post('back/email-user', array('as' => 'users.sendEmail', 'uses' => 'Back\\UsersController@sendEmail'));
	Route::resource('back/logs', 'Back\\LogsController', ['only' => ['show', 'destroy']]);
	

	Route::resource('back/activities', 'Back\\ActivitiesController');
	Route::post('back/activities/index', array('as' => 'activities.changeStatus', 'uses' => 'Back\\ActivitiesController@changeStatus'));
	Route::resource('back/agenda', 'Back\\AgendaController');
	Route::post('back/agenda/index', array('as' => 'agenda.changeStatus', 'uses' => 'Back\\AgendaController@changeStatus'));
	Route::resource('back/team', 'Back\\TeamController');
	Route::post('back/team/index', array('as' => 'team.changeStatus', 'uses' => 'Back\\TeamController@changeStatus'));
	Route::post('back/trainees/index', array('as' => 'trainees.changeStatus', 'uses' => 'Back\\TraineesController@changeStatus'));


	Route::resource('back/permanences', 'Back\\PermanencesController');
	Route::post('back/permanences', array('as' => 'permanences.update_attribution', 'uses' => 'Back\\PermanencesController@update_attribution'));
	// Send Email to inform opening of permanences writing period
	Route::get('back/permanences/email-lawyer/{id}', array('as' => 'permanences.showEmail', 'uses' => 'Back\\PermanencesController@showEmail'));
	Route::post('back/permanences/index', array('as' => 'permanences.sendEmail', 'uses' => 'Back\\PermanencesController@sendEmail'));

	// Route::resource('back/permanences-attribution', 'Back\\PermanencesAttributionController');
	// Route::resource('back/permanences-attribution2', 'Back\\PermanencesAttributionController2');
	// Route::post('back/permanences-attribution/reGeneratePermanencesList', array('as' => 'permanences-attribution.reGeneratePermanencesList', 'uses' => 'Back\\PermanencesAttributionController@reGeneratePermanencesList'));

	Route::resource('back/calendar', 'Back\\CalendarController');
	Route::resource('back/lawyers', 'Back\\LawyersController');
	Route::post('back/email-lawyers', array('as' => 'lawyers.sendEmail', 'uses' => 'Back\\LawyersController@sendEmail'));
	Route::get('back/email-lawyer/{id}', array('as' => 'lawyers.showEmail', 'uses' => 'Back\\LawyersController@showEmail'));

	// Manually add available lawyer to permanence attribution list
	// Route::get('back/permanences/{year}/{quarter}/add', array('as' => 'permanences.showAddLawyerToPermanencesAttributionForm', 'uses' => 'Back\\PermanencesController@showAddLawyerToPermanencesAttributionForm'));
	// Route::post('back/permanences/{year}/{quarter}/{lawyer}/add', array('as' => 'permanences.addLawyerToPermanencesAttribution', 'uses' => 'Back\\PermanencesAttributionController@addLawyerToPermanencesAttribution'));
	// Route::post('back/permanences/{year}/{quarter}', array('as' => 'permanences.generateAttributionsTable', 'uses' => 'Back\\PermanencesAttributionController@generateAttributionsTable'));


	Route::resource('back/members', 'Back\\MembersController');
	Route::post('back/activate-member', array('as' => 'members.changeStatus', 'uses' => 'Back\\MembersController@changeStatus'));
	Route::get('back/email-member/{id}', array('as' => 'members.showEmail', 'uses' => 'Back\\MembersController@showEmail'));
	Route::post('back/email-member', array('as' => 'members.sendEmail', 'uses' => 'Back\\MembersController@sendEmail'));


	// Route::get('back/timeline', array('as' => 'timeline', 'uses' => 'Back\\BackController@timeline'));
	// Route::get('back/timeline2', array('as' => 'timeline2', 'uses' => 'Back\\BackController@timeline2'));
	Route::resource('back/lawyers-office', 'Back\\LawyersOfficeController');
	Route::post('back/permanences/generateAttributions/{year}/{quarter}', array('as' => 'permanences.generateAttributions', 'uses' => 'Back\\PermanencesController@generateAttributions'));
	Route::post('back/permanences/copyPermanencesTable', array('as' => 'permanences.copyPermanencesTable', 'uses' => 'Back\\PermanencesController@copyPermanencesTable'));
	Route::post('back/permanences/deleteAttributions/{year}/{quarter}', array('as' => 'permanences.deletePermanencesAttributions', 'uses' => 'Back\\PermanencesController@deletePermanencesAttributions'));
	Route::post('back/permanences/toggleShowAttributions', array('as' => 'permanences.toggleShowAttributions', 'uses' => 'Back\\PermanencesController@toggleShowAttributions'));

	Route::resource('back/trainees', 'Back\\TraineesController');
});