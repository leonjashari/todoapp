<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
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

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::post('/todos/{todo}/complete', [TodoController::class, 'complete'])->name('todos.complete');
    Route::get('/todos', [TodoController::class, 'index']);
    Route::get('/todos/done', [TodoController::class, 'done'])->name('todos.done');
    Route::get('/todos/group/{group}/done', [TodoController::class, 'groupDone'])->name('todos.group.done');
    Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
    Route::get('/todos/urgent', [TodoController::class, 'urgent'])->name('todos.urgent');
    Route::patch('/todos/{id}/done', [TodoController::class, 'markAsDone'])->name('todos.markAsDone');
    Route::post('/todos/addGroup', [TodoController::class, 'addGroup'])->name('todos.addGroup');

    Route::resource('todos', TodoController::class);
    Route::get('/todos/group/{group}', [TodoController::class, 'group'])->name('todos.group');
    Route::post('/todos/add-group', [TodoController::class, 'addGroup'])->name('todos.addGroup');
});

Route::post('/', [TodoController::class, 'store'])->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
Route::post('/todos/{id}/edit', [TodoController::class, 'edit'])->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
Route::get('/todos/{todo}/show', [TodoController::class, 'show'])->name('todos.show');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

