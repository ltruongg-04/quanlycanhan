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
use Illuminate\Http\Request;


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


Route::get('/admin', function () {
    return view('admin.home');
})->name('admin.home');

Route::get('/user', function () {
    return view('home');
})->name('user.home');

Route::get('/admin/users', function () {
    $users = [
        ['id' => 1, 'name' => 'Nguyễn Văn Anh'],
        ['id' => 2, 'name' => 'Nguyễn Thị Minh Anh'],
        ['id' => 3, 'name' => 'Nguyễn Thị Ngọc Anh'],
        ['id' => 4, 'name' => 'Nguyễn Trâm Anh'],
        ['id' => 5, 'name' => 'Nguyễn Mai Anh'],
        ['id' => 6, 'name' => 'Trần Thị Minh Anh'],
        ['id' => 7, 'name' => 'Nguyễn Thị Minh Anh'],
        ['id' => 8, 'name' => 'Nguyễn Thị Minh Anh'],
        ['id' => 9, 'name' => 'Nguyễn Thị Minh Anh'],
    ];
    return view('admin.quanlynguoidung.index', compact('users'));
})->name('admin.users');

Route::get('/admin/users/{id}', function($id) {
    $users = [
        ['id' => 1, 'name' => 'Nguyễn Văn Anh', 'birthday' => '2004-10-24', 'gender' => 'Nam', 'email' => 'email1@gmail.com', 'phone' => '0123456789'],
        ['id' => 2, 'name' => 'Nguyễn Thị Minh Anh', 'birthday' => '2000-05-12', 'gender' => 'Nữ', 'email' => 'email2@gmail.com', 'phone' => '0987654321'],
    ];

    $user = collect($users)->firstWhere('id', (int)$id);
    if (!$user) {
        abort(404);
    }

    return view('admin.quanlynguoidung.profile', ['user' => (object) $user]);
})->name('admin.user_detail');

Route::get('/admin/notifications', function () {
    $sent_notifications = [
        ['icon' => 'fa-solid fa-xmark', 'message' => 'Bạn đã bỏ lỡ thói quen đọc sách hôm qua.', 'time' => '30 phút trước', 'user' => 'Nguyễn Lê Trường'],
        ['icon' => 'fa-solid fa-check-to-slot', 'message' => 'Hệ thống sẽ bảo trì từ 22:00 - 02:00 ngày 20/03. Vui lòng sắp xếp công việc trước thời gian này để tránh gián đoạn!', 'time' => 'Hôm qua', 'user' => 'Mọi người'],
        ['icon' => 'fa-solid fa-chart-line', 'message' => 'Bạn đã hoàn thành hết công việc của hôm nay. Bạn làm tốt lắm!!', 'time' => 'Hôm qua', 'user' => 'Nguyễn Lê Trường'],
        ['icon' => 'fa-solid fa-repeat', 'message' => 'Bạn đang rất chăm chỉ, hãy cố gắng nhé!!', 'time' => '2 hôm trước', 'user' => 'Mọi người'],
        ['icon' => 'fa-solid fa-repeat', 'message' => 'Đã đến lúc kiểm tra tiến độ công việc tuần này rồi.', 'time' => '2 hôm trước', 'user' => 'Mọi người'],
    ];

    $unsent_notifications = [
        ['icon' => 'fa-solid fa-xmark', 'message' => 'Bạn đã bỏ lỡ thói quen đọc sách hôm qua.', 'time' => '15/03/2025 08:20', 'user' => 'Nguyễn Lê Trường'],
        ['icon' => 'fa-solid fa-check-to-slot', 'message' => 'Hệ thống sẽ bảo trì từ 22:00 - 02:00 ngày 20/03. Vui lòng sắp xếp công việc trước thời gian này để tránh gián đoạn!', 'time' => '12/03/2025 08:00', 'user' => 'Mọi người'],
        ['icon' => 'fa-solid fa-chart-line', 'message' => 'Bạn đã hoàn thành hết công việc của hôm nay. Bạn làm tốt lắm!!', 'time' => '11/03/2025  23:30', 'user' => 'Nguyễn Lê Trường'],
        ['icon' => 'fa-solid fa-repeat', 'message' => 'Bạn đang rất chăm chỉ, hãy cố gắng nhé!!', 'time' => '08/03/2025  23:00', 'user' => 'Mọi người'],
        ['icon' => 'fa-solid fa-repeat', 'message' => 'Đã đến lúc kiểm tra tiến độ công việc tuần này rồi.', 'time' => '05/03/2025  08:00', 'user' => 'Mọi người'],
    ];

    return view('admin.quanlythongbao.index', compact('sent_notifications', 'unsent_notifications'));
})->name('admin.notifications');

Route::post('/admin/notifications/store', function (Request $request) {
    dd($request->all());
})->name('admin.notifications.store');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');