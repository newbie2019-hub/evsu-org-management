<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegValidationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::group(['prefix' => 'admin'], function (){
        Route::post('login', [AdminAuthController::class, 'login']);
        Route::post('logout', [AdminAuthController::class, 'logout']);
        Route::post('update', [AdminAuthController::class, 'update']);
        Route::post('change_password', [AdminAuthController::class, 'changePassword']);
        Route::post('me', [AdminAuthController::class, 'me']);
    });

    Route::group(['prefix' => 'user'], function (){
        Route::post('store', [UserController::class, 'store']);
        Route::post('login', [UserController::class, 'login']);
        Route::post('logout', [UserController::class, 'logout']);
        Route::put('update', [UserController::class, 'update']);
        Route::post('me', [UserController::class, 'me']);
    });
});
Route::group(['middleware' => 'api'], function (){

    Route::post('conversation/messages', [ChatController::class, 'messages']);
    Route::apiResource('message', ChatController::class);

    Route::group(['prefix' => 'admin'], function (){
        Route::get('college/all', [CollegeController::class, 'showall']);
        Route::apiResource('college', CollegeController::class);
        Route::apiResource('courses', CoursesController::class);
        Route::get('organization/all', [OrganizationController::class, 'showall']);
        Route::apiResource('organization', OrganizationController::class);
        Route::apiResource('students', StudentsController::class);
        Route::get('sections/all', [SectionsController::class, 'showall']);
        Route::apiResource('sections', SectionsController::class);
        Route::get('pendingstudents', [StudentsController::class, 'pendingStudents']);
        Route::put('approve/{id}', [StudentsController::class, 'approveStudent']);
    });

    Route::group(['prefix' => 'user'], function (){
        Route::get('members/all', [MembersController::class, 'showall']);
        Route::get('pendingmembers', [MembersController::class, 'pendingMembers']);
        Route::get('admins', [MembersController::class, 'allAdmins']);
        Route::apiResource('members', MembersController::class);
        Route::put('approve/{id}', [MembersController::class, 'approveMember']);
        Route::get('announcement/all', [AnnouncementController::class, 'showall']);
        Route::apiResource('announcement', AnnouncementController::class);
        Route::apiResource('payments', PaymentController::class);
    });
});

Route::post('validateEmail', [RegValidationController::class, 'validateEmail']);
