<?php

use App\Http\Controllers\Api\ClasseController;
use App\Http\Controllers\Api\EnrollmentController;
use App\Http\Controllers\Api\GradeLevelController;
use App\Http\Controllers\Api\SchoolYearController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\SubjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/niveaux')
    ->name('grade_level')
    ->controller(GradeLevelController::class)
    ->group(function () {
        Route::get('/', 'all')->name('all');
        Route::get('/{grade_level}', 'show')->whereNumber('grade_level')->name('show');
    });

Route::prefix('/classes')
    ->controller(ClasseController::class)
    ->group(function () {
        Route::post('/{classe}/add-subject', 'addSubject');
    });

Route::prefix('/eleves')
    ->name('students.')
    ->group(function () {
        Route::apiResource('/', StudentController::class)->only(['store', 'index']);
        Route::get('/liste/{classeId}', [EnrollmentController::class, 'studentsList']);
        Route::post('/sortie', [StudentController::class, 'out']);
        Route::post('/entree', [StudentController::class, 'in']);
        Route::post('/{student}/add-note', [StudentController::class, 'addNote']);
    });

Route::prefix('/years')
    ->name('years.')
    ->controller(SchoolYearController::class)
    ->group(function () {
        Route::get('/all', 'all');
    });

Route::prefix('/disc')
    ->name('subjects.')
    ->controller(SubjectController::class)
    ->group(function () {
        Route::get('/all', 'all');
        Route::get('/group/all', 'allGroups');
        Route::post('/create', 'store');
    });

// Route::get('/test/{test}', [SubjectController::class, 'test']);
