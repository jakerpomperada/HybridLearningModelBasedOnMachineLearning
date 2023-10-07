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

    Route::post('image-upload', 'UploadImageController@store');

    Route::get('/', 'LoginController@index');
    Route::post('/login', 'LoginController@login');


