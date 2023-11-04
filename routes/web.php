<?php
	
	use Illuminate\Support\Facades\Route;
	
	/*
	|--------------------------------------------------------------------------
	| Web Routes
	|--------------------------------------------------------------------------
	|
	| Here is where you can register web routes for your application. These
	| routes are loaded by the RouteServiceProvider and all of them will
	| be assigned to the "web" middleware group. Make something great!
	|
	*/
	
	Route::get('/', function () {
		return view('welcome');
	});
	
	
	Route::group(['prefix' => 'admin'], function () {
		Route::get('dashboard', 'DashboardAdminController@index');
	});
	
	Route::group(['prefix' => 'teacher', 'namespace' => 'Teacher', 'middleware' => 'auth'], function () {
		Route::get('dashboard', 'DashboardController@index');
		Route::resource('student-attendance', 'StudentAttendanceController');
		Route::resource('student-participation', 'StudentParticipationController');
		Route::resource('student-task_performance', 'StudentTaskPerformanceController');
		Route::resource('student-quiz', 'StudentQuizController');
		Route::resource('student-exam', 'StudentExamController');
	});
	
	
	Route::group(['middleware' => 'auth'], function () {
		Route::resource('/course', 'CourseController');
		Route::resource('/subject', 'SubjectController');
		Route::resource('/teacher', 'TeacherController');
		Route::resource('/student', 'StudentController');
		Route::resource('/academic-term', 'AcademicTermController');
		
		Route::get('/subject-term', 'SubjectTermController@index');
		Route::get('/subject-term/{id}', 'SubjectTermController@show');
		Route::put('/subject-term/{id}', 'SubjectTermController@update');
		Route::delete('/subject-term/{id}', 'SubjectTermController@destroy');
		Route::post('/subject-term', 'SubjectTermController@store');
		Route::get('/subject-term/get/data', 'SubjectTermController@getData');
		
		Route::resource('/student-admission', 'StudentAdmissionController');
		Route::resource('/teaching-load', 'TeachingLoadController');
		
		Route::post('image-upload', 'UploadImageController@store');
		
		
	});
	
	Route::get('/', ['as' => 'login', 'uses' => 'LoginController@index']);
	Route::post('/login', 'LoginController@login');
	Route::get('/logout', 'LogoutController@index');


