<?php
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
});

Route::middleware(['auth'])->group(function () {
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
});
    Route::middleware(['can:isAdmin'])->group(function () {
        Route::get('/admin/tasks', [AdminController::class, 'index'])->name('admin.tasks.index');
        Route::post('/admin/tasks', [AdminController::class, 'store'])->name('admin.tasks.store');
        Route::delete('/admin/tasks/{task}', [AdminController::class, 'destroy'])->name('admin.tasks.destroy');
    });

require __DIR__.'/auth.php';
