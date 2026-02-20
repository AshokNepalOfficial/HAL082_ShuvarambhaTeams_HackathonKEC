<?php

use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MessageController;
use App\Models\Chatbot;





Route::get('/', function (){
    return view('welcome');
});

// Route::get('chatbot_interface',function(){
//     return view('chatbot_interface.index');
// });

Route::delete('/users/delete/{id}', [UserManagementController::class, 'destroy'])->name('users.destroy');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', function () {
        // Return JSON in a pretty format
        return view('dashboard');
    })->name('dashboard');




Route::get('/file-manager', [FileManagerController::class, 'index'])->name('file-manager.index');
Route::get('userdata', function () {
    // Number of users per page
    $perPage = 10;
    // Get users ordered by newest first, paginated
    $users = \App\Models\User::orderBy('id', 'desc')->paginate($perPage);
    // Return JSON in a pretty format
    return response()->json($users, 200, [], JSON_PRETTY_PRINT);
});







Route::get('chatbotdata', function (){
    // Number of users per page
    $perPage = 10;
    // Get users ordered by newest first, paginated
    $chatbots = \App\Models\Chatbot::orderBy('id', 'desc')->paginate($perPage);
    // Return JSON in a pretty format
    return response()->json($chatbots, 200, [], JSON_PRETTY_PRINT);
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
    Route::get('chatbots', [ChatbotController::class, 'index'])->name('chatbots.index');
    Route::post('chatbots', [ChatbotController::class, 'store'])->name('chatbots.store');
    // 1️⃣ Show the edit form (GET request)
    Route::get('/chatbots/{chatbot}/edit', [ChatbotController::class, 'edit'])
        ->name('chatbot.edit');

    // 2️⃣ Handle form submission / save updates (POST request)
    Route::post('/chatbots/{chatbot}/edit', [ChatbotController::class, 'update'])
        ->name('chatbot.update');
    // Add a new Few Shot (via AJAX)
    Route::post('/chatbots/{chatbot}/fewshots', [ChatbotController::class, 'addFewShot'])
        ->name('chatbot.fewshots.add');

    // Delete a Few Shot (via AJAX)
    Route::delete('/chatbots/{chatbot}/fewshots/{index}', [ChatbotController::class, 'deleteFewShot'])
        ->name('chatbot.fewshots.delete');

    Route::delete('chatbots/{chatbotId}', [ChatbotController::class, 'destroy'])->name('chatbots.destroy');







Route::prefix('chatbots/{chatbot}')->group(function () {
    // The main interface view
    Route::get('/interface', function (Chatbot $chatbot) {
        return view('chatbot_interface.index', compact('chatbot'));
    })->name('chatbots.interface');

    // Conversation & Message logic
    Route::get('/conversations', [ConversationController::class, 'index']);
    Route::post('/conversations', [ConversationController::class, 'store']);
    Route::get('/conversations/{conversation}/messages', [MessageController::class, 'index']);
    Route::post('/conversations/{conversation}/messages', [MessageController::class, 'store']);
});
});
require __DIR__.'/auth.php';
