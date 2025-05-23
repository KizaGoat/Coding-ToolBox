<?php

use App\Http\Controllers\CohortController;
use App\Http\Controllers\CommonLifeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RetroController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

// Redirect the root path to /dashboard
Route::redirect('/', 'dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('verified')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Cohorts
        Route::get('/cohorts', [CohortController::class, 'index'])->name('cohort.index');
        Route::get('/cohort/{cohort}', [CohortController::class, 'show'])->name('cohort.show');

        // Teachers
        Route::get('/teachers', [TeacherController::class, 'index'])->name('teacher.index');

        // Students
        Route::get('students', [StudentController::class, 'index'])->name('student.index');
        Route::post('students', [StudentController::class, 'store'])->name('student.store');

        // Knowledge
        Route::get('knowledge', [KnowledgeController::class, 'index'])->name('knowledge.index');

        // Groups
        Route::get('groups', [GroupController::class, 'index'])->name('group.index');

        // Retro
        route::get('retros', [RetroController::class, 'index'])->name('retro.index');

        // Common life
        Route::get('common-life', [CommonLifeController::class, 'index'])->name('common-life.index');

        // redirection for all on the dashboard
        Route::get('/pages/students/index', function () {
            return view('pages.students.index');
        })->name('pages.students.index');

        Route::get('/pages/groups/index', function () {
            return view('pages.groups.index');
        })->name('pages.groups.index');

        Route::get('/pages/teachers/index', function () {
            return view('pages.teachers.index');
        })->name('pages.teachers.index');

        Route::get('/pages/cohorts/index', function () {
            return view('pages.cohorts.index');
        })->name('pages.cohorts.index');

        Route::get('pages/dashboard/dashboard-admin', [DashboardController::class, 'index']);

        Route::get('pages/common-life', [CommonLifeController::class, 'index'])->name('commonLife.index');

        Route::post('pages/common-life', [CommonLifeController::class, 'store'])->name('commonLife.store');

        Route::post('pages/common-life/{id}/complete', [CommonLifeController::class, 'complete'])->name('commonLife.complete');

        Route::group(['middleware' => ['web']], function () {

        });

        Route::post('/students', [StudentController::class, 'store'])->name('student.store');
        Route::delete('student/{id}', [StudentController::class, 'destroy'])->name('student.destroy');

        Route::post('/teachers', [TeacherController::class, 'store'])->name('teacher.store');
        Route::delete('teacher/{id}', [TeacherController::class, 'destroy'])->name('teacher.destroy');

        Route::post('/cohorts', [CohortController::class, 'store'])->name('cohort.store');
        Route::delete('cohort/{id}', [CohortController::class, 'destroy'])->name('cohort.destroy');

        Route::middleware('auth')->group(function () {
            Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::post('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
            Route::put('/profile/info', [ProfileController::class, 'updateProfileInfo'])->name('profile.update.info');
        });

        Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');

        Route::put('/teacher/{id}', [TeacherController::class, 'update'])->name('teacher.update');

        Route::put('/cohort/{id}', [CohortController::class, 'update'])->name('cohort.update');

        Route::put('/student/{id}', [StudentController::class, 'update'])->name('student.update');



    });

});

require __DIR__.'/auth.php';
