<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Academics\BoardsController;
use App\Http\Controllers\User\PermissionController;
use App\Http\Controllers\User\RoleController;
use App\Http\Controllers\User\UserController;
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

// Route::get('/', function () {
//     return view('content.index');
// });

Route::get('/', function () {
    return view('content.index');
});

Route::get('academics/boards', [BoardsController::class, 'index'])->name('academics.boards');
Route::get('academics/board/add', [BoardsController::class, 'addBoards'])->name('academics.board.add');


Route::post('/academics/boards/store', [BoardsController::class, 'store'])->name('boards.store');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('content.dashboards.admin-dashboards');
    })->name('dashboard');
});


Route::group(['middleware' => ['auth']], function () {
  // Roles & Permissions
  Route::get('/users/permissions', [PermissionController::class, 'index'])->name('users.permissions');
  Route::get('/users/permissions/create', [PermissionController::class, 'create'])->name('users.permissions.create');
  Route::post('/users/permissions', [PermissionController::class, 'store'])->name('users.permissions');

  // Roles
  Route::get('/users/roles', [RoleController::class, 'index'])->name('users.roles');
  Route::get('/users/roles/create', [RoleController::class, 'create'])->name('users.roles.create');
  Route::post('/users/roles', [RoleController::class, 'store'])->name('users.roles');
  Route::get('/users/roles/edit/{id}', [RoleController::class, 'edit'])->name('users.roles.edit');
  Route::post('/users/roles/update', [RoleController::class, 'update'])->name('users.roles.update');

  // Users
  Route::get('/users', [UserController::class, 'index'])->name('users');
  Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
  Route::post('/users', [UserController::class, 'store'])->name('users');
 
  // Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
  // Route::post('/users/update', [UserController::class, 'update'])->name('users.update');
  // Route::get('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
});

