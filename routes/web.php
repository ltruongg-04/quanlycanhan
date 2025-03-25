<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AuthAdmin;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\HabitTrackingController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\UserProfileController;


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/thoi-quen', [HabitController::class, 'index'])->name('thoi-quen')->middleware('auth');



Route::get('/thoi-quen/create', [HabitController::class, 'create'])->name('thoi-quen.create');
Route::post('/thoi-quen', [HabitController::class, 'store'])->name('thoi-quen.store');
Route::get('/thoi-quen/{id}/edit', [HabitController::class, 'edit'])->name('thoi-quen.edit');
Route::put('/thoi-quen/{id}', [HabitController::class, 'update'])->name('thoi-quen.update');
Route::delete('/thoi-quen/{id}', [HabitController::class, 'destroy'])->name('thoi-quen.destroy');



Route::get('/muc-tieu', [GoalController::class, 'index'])->name('muc-tieu');
Route::get('/muc-tieu/create', [GoalController::class, 'create'])->name('muc-tieu.create');
Route::post('/muc-tieu', [GoalController::class, 'store'])->name('muc-tieu.store');
Route::get('/muc-tieu/{id}/edit', [GoalController::class, 'edit'])->name('muc-tieu.edit');
Route::put('/muc-tieu/{id}', [GoalController::class, 'update'])->name('muc-tieu.update');
Route::delete('/muc-tieu/{id}', [GoalController::class, 'destroy'])->name('muc-tieu.destroy');



Route::get('/habit-tracking/status', [HabitTrackingController::class, 'getTrackingStatus']);
Route::get('/habit-tracking/stats', [HabitTrackingController::class, 'getHabitStats']);
Route::post('/habit-tracking/{tracking_id}/complete', [GoalController::class, 'markHabitCompleted']);

Route::post('/habit-tracking/toggle', [GoalController::class, 'toggleHabitTracking']);

Route::post('/update-tracking-status', [HabitTrackingController::class, 'updateTrackingStatus']);


Route::get('/cong-viec', [TaskController::class, 'full'])->name('cong-viec');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('cong-viec.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('cong-viec.store');
Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('cong-viec.edit');
Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('cong-viec.update');

Route::get('/cong-viec/month/{month}', [TaskController::class, 'getTasksByMonth']);
Route::get('/cong-viec-tuan', [TaskController::class, 'weeklyTasks'])->name('cong-viec.tuan');


Route::get('/ho-tro', [SupportController::class, 'index'])->name('ho-tro');
Route::get('/ho-tro-chat', [SupportController::class, 'chat'])->name('ho-tro.chat');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [UserProfileController::class, 'update'])->name('profile.update');
});
