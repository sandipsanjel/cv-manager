<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserCvController;
use App\Http\Controllers\admin\CVStatusController;
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
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::get('/user-cv/create', [UserCVController::class, 'create'])->name('user_cv.create');
Route::post('/user-cv/store', [UserCVController::class, 'store'])->name('user_cv.store');
// Route::get('/user-cv', [UserCVController::class, 'index'])->name('user_cv.index');


//admin accessible routes
Route::prefix('admin')->middleware(['auth', 'authisadmin'])->group(function () {
    Route::get('/user-cv', [UserCVController::class, 'index'])->name('user_cv.index');
    Route::get('showusers/{id}', [UserCVController::class, 'show'])->name('user_cv.showusers');
    // Route::post('/cv_status/store', [CVStatusController::class, 'store'])->name('cv_status.store');
    Route::get('cv_status/edit/{id}', [CVStatusController::class, 'edit'])->name('cv_status.edit');
    Route::post('cv_status/update/{id}', [CVStatusController::class, 'update'])->name('cv_status.update');
    // Route::get('cv_status/delete/{id}', [CVStatusController::class, 'delete'])->name('cv_status.delete');
});
