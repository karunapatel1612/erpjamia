<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Academics\BoardsController;
use App\Http\Controllers\User\PermissionController;
use App\Http\Controllers\User\RoleController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Setting\AdmissionTypeController;

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


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('content.dashboards.admin-dashboards');
    })->name('dashboard');
});


Route::group(['middleware' => ['role:super-admin|admin']], function() {

    Route::resource('permissions', PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);

    Route::resource('roles', RoleController::class);
    Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);

    Route::resource('users', UserController::class);
    Route::get('users/{userId}/delete', [UserController::class, 'destroy']);

  // Users
  Route::get('/users', [UserController::class, 'index'])->name('users');
  Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
  Route::post('/users', [UserController::class, 'store'])->name('users');
 
  // Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
  // Route::post('/users/update', [UserController::class, 'update'])->name('users.update');
  // Route::get('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');

// Setting Route
  Route::get('/setting/admission_types', [AdmissionTypeController::class, 'index'])->name('setting.admission_types');
  Route::get('/setting/admission_types/create', [AdmissionTypeController::class, 'create'])->name('setting.admission_types.create');
  Route::post('/setting/admission_types/store', [AdmissionTypeController::class, 'store'])->name('setting.admission_types.store');
//   Route::get('/setting/admission_types/edit/{id}', [AdmissionTypeController::class, 'edit'])->name('setting.admission_types.edit');
Route::get('setting/admission_types/edit/{id}', [AdmissionTypeController::class, 'edit'])->name('setting.admission_types.edit');
Route::post('setting/admission_types/update/{id}', [AdmissionTypeController::class, 'update'])->name('setting.admission_types.update');
Route::get('setting/admission_types/status/{id}', [AdmissionTypeController::class, 'status'])->name('setting.admission_types.status');

Route::delete('setting/admission_types/destroy/{id}', [AdmissionTypeController::class, 'destroy'])->name('setting.admission_types.destroy');







});

Route::group(['middleware' => ['auth']], function() {

    Route::resource('roles', RoleController::class);

});