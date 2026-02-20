<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\FolderController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FileManagerController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


use App\Http\Controllers\UserManagementController;


Route::delete('/users/delete/{id}', [UserManagementController::class, 'destroy'])->name('users.destroy');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');




Route::get('/file-manager', [FileManagerController::class, 'index'])->name('file-manager.index');
Route::get('userdata', function () {
    // Number of users per page
    $perPage = 10;
    // Get users ordered by newest first, paginated
    $users = \App\Models\User::orderBy('id', 'desc')->paginate($perPage);
    // Return JSON in a pretty format
    return response()->json($users, 200, [], JSON_PRETTY_PRINT);
});




Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
Route::get('/users/search', [UserManagementController::class, 'search'])->name('users.search');
Route::post('/users/update', [UserManagementController::class, 'update'])->name('users.update');

});














Route::middleware('auth')->group(function () {
    // Folder routes
    Route::get('/folders', [FolderController::class, 'index'])->name('folders.index');
    Route::post('/folders', [FolderController::class, 'store'])->name('folders.store');
    Route::post('/folders/{folder}/rename', [FolderController::class, 'rename'])->name('folders.rename');
    Route::delete('/folders/{folder}', [FolderController::class, 'destroy'])->name('folders.destroy');

    // File routes
    Route::post('/folders/{folder}/files', [FileController::class, 'store'])->name('files.store');
    Route::post('/files/{file}/rename', [FileController::class, 'rename'])->name('files.rename');
    Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.destroy');
});




Route::middleware('auth')->group(function () {
    // Folder routes
    Route::get('chatbots', [FolderController::class, 'index'])->name('chatbots.index');
    Route::post('chatbots', [FolderController::class, 'store'])->name('chatbots.store');
    Route::post('chatbots/{folder}/rename', [FolderController::class, 'rename'])->name('chatbots.rename');
    Route::delete('chatbots/{folder}', [FolderController::class, 'destroy'])->name('chatbots.destroy');
});
require __DIR__.'/auth.php';
