<?php

use App\Http\Controllers\Api\ClasseController;
use App\Http\Controllers\Api\EnrollmentController;
use App\Http\Controllers\Api\GradeLevelController;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\Api\SchoolYearController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\SubjectController;
use App\Models\SchoolYear;
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

Route::prefix('/eleves')
    ->controller(StudentController::class)
    ->name('students.')
    ->group(function () {
        Route::post('/', 'store');
        Route::patch('/sortie', 'out');
        Route::patch('/entree', 'in');
    });

Route::prefix('/annees')
    ->name('years.')
    ->controller(SchoolYearController::class)
    ->group(function () {
        Route::get('/all', 'all');
    });

Route::prefix('/disciplines')
    ->name('subjects.')
    ->controller(SubjectController::class)
    ->group(function () {
        Route::get('/all', 'all');
        Route::get('/group', 'allGroups');
        Route::post('/create', 'store');
    });

Route::get('/classe/{classe}/liste', [EnrollmentController::class, 'studentsList']);
Route::post('/add-notes/{classe}/{subject}/{evaluation}', [NoteController::class, 'addNote']);

// Route::get('/test/{test}', [SubjectController::class, 'test']);
// Route::get('/test', [StudentController::class, 'test']);
