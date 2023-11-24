<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\DocumentUploadController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {

    /**
     * Returns a random new name
     */
    Route::get('name', function () {
        return fake()->name();
    })->name('api.name')->can('getName', User::class);

    //Route::get('/users', [UserController::class, 'index']);
    //Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::delete('/loans/{loan}', [LoanController::class, 'destroy'])->name('loans.destroy');

}); 

// Route::method('/url', [Controller:class, 'methodAction'])
//     ->name('name')
//     ->can('ability', 'policy')

Route::post('/loans', [LoanController::class, 'store'])
    ->name('loans.store'); 

Route::post('/document-upload', [DocumentUploadController::class, 'upload'])
    ->name('api.documents.store');



// Admin Authentication

Route::post('/admin/register', [AdminAuthController::class, 'register2'])->name('admin.register2');

Route::get('/dashboard', [LoanController::class, 'show']);
Route::get('/dashboard', [UserController::class, 'show']);

