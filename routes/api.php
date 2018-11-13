<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->get('/student',function(Request $request){
    return $request->student();
});

Route::apiResources(['user'=>'API\UserController']);
Route::apiResources(['student'=>'API\StudentController']);
Route::apiResources(['studentlist'=>'API\StudentController']);
Route::apiResources(['program'=>'API\ProgramController']);
Route::apiResources(['courses'=>'API\CoursesController']);
Route::apiResources(['curriculum'=>'API\CurriculumController']);
Route::apiResources(['enrollment'=>'API\EnrollmentController']);
Route::apiResources(['enrollmentassoc'=>'API\EnrollmentAssocController']);
Route::apiResources(['semester'=>'API\SemesterController']);
Route::apiResources(['yearlevel'=>'API\YearLevelController']);
Route::apiResources(['section'=>'API\SectionController']);

Route::get('courselist','API\CoursesController@CourseList');
Route::get('curriculumlist','API\CurriculumController@CurriculumList');
Route::get('enrollList','API\EnrollmentController@EnrollList');
Route::get('enrollAll','API\EnrollmentController@EnrollAll');
Route::get('profile','API\StudentController@student');
Route::get('studentlist','API\StudentController@StudentList');




// Global Search
Route::get('findStudent', 'API\StudentController@search');
Route::get('findStudentID', 'API\EnrollmentController@searchID');
Route::get('findUser', 'API\UserController@search');
Route::get('findFormID', 'API\EnrollmentAssocController@search');
Route::get('findCurr', 'API\CurriculumController@search');
Route::get('findCourse', 'API\CoursesController@search');

// Route::get('enrollmentassoc/{id}','API\EntrollmentAssocController@show');
