<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourceController;
use App\Http\Controllers\ScheduledController;
use App\Http\Controllers\SubjectController;
 
Route::post(
    '/auth/login',
    [AuthController::class, 'login_user']
)->name('login');

//protected routes
Route::group(['middleware' => ['jwt.auth']], function() {
    
    Route::controller(CourceController::class)->group(function () {
        Route::get(
            '/course',
            [CourceController::class, 'index']
        );
        Route::post(
            '/course',
            [CourceController::class, 'saveCources']
        );
        //pending
        Route::post(
            '/course/{courseId}/enroll-student',
            [CourceController::class, 'enrollStudents']
        );
    });

    Route::controller(SubjectController::class)->group(function () {
        Route::get(
            '/subject',
            [SubjectController::class, 'index']
        );
        Route::post(
            '/subject',
            [SubjectController::class, 'saveSubject']
        );
    });

    Route::controller(ScheduledController::class)->group(function () {
        Route::get(
            '/schedule',
            [ScheduledController::class, 'index']
        );
        Route::post(
            '/schedule',
            [ScheduledController::class, 'createSchedule']
        );
    });

});