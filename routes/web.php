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
    if (auth()->user()->hasRole('student')) {
        return redirect()->route('student.course');
    }
    if (auth()->user()->hasRole('teacher')) {
        return redirect()->route('courses.index');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('courses', CourseController::class);
    Route::resource('lessons', LessonController::class);
    Route::resource('tasks', \App\Http\Controllers\TaskController::class);
    Route::get('students', [\App\Http\Controllers\StudentController::class, 'students'])->name('students');
    Route::get('student-status/{id}', [\App\Http\Controllers\StudentController::class, 'studentStatus'])->name('student-status');
    Route::get('student-delete/{id}', [\App\Http\Controllers\StudentController::class, 'studentDelete'])->name('student-delete');
    Route::get('/course',[\App\Http\Controllers\StudentController::class, 'course'])->name('student.course');
    Route::get('my-courses', [\App\Http\Controllers\StudentController::class, 'myCourses'])->name('my-courses');
    Route::get('/course-lessons/{id}',[\App\Http\Controllers\StudentController::class, 'courseLessons'])->name('student.course-lessons');
    Route::get('/course-detail/{id}',[\App\Http\Controllers\StudentController::class, 'courseDetail'])->name('student.course-detail');
    Route::get('/course-start/{id}/{teacher}',[\App\Http\Controllers\StudentController::class, 'courseStart'])->name('student.course-start');
    Route::get('check-task/{course_id}',[\App\Http\Controllers\StudentController::class, 'checkTask'])->name('check-task');
    Route::get('task_download/{task_id}',[\App\Http\Controllers\TaskController::class, 'taskDownload'])->name('task_download');
    Route::post('check-save',[\App\Http\Controllers\TaskController::class,'check_save'])->name('check-save');
    Route::post('get-sertificate',[\App\Http\Controllers\TaskController::class,'get_sertificate'])->name('get-sertificate');
});

require __DIR__.'/auth.php';
