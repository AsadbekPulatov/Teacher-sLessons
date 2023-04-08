<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('courses', CourseController::class);
    Route::resource('lessons', LessonController::class);
    Route::get('students', [\App\Http\Controllers\StudentController::class, 'students'])->name('students');
    Route::get('/course',[\App\Http\Controllers\StudentController::class, 'course'])->name('student.course');
    Route::get('/course-detail/{id}',[\App\Http\Controllers\StudentController::class, 'courseDetail'])->name('student.course-detail');
    Route::get('/course-start/{id}/{teacher}',[\App\Http\Controllers\StudentController::class, 'courseStart'])->name('student.course-start');
});

require __DIR__.'/auth.php';
