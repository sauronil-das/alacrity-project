<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\DocumentUploadController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/**
 * Include the default register / login routes.
 */
require __DIR__.'/defaults.php';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/example1', function () {
    // Render component and pass props
    return Inertia::render('Example1', [
        'initialNames' => [
            'Alice',
            'Bob',
            'Carol'
        ]
    ]);
})->name('example1');

Route::get('/example2', function () {
    return Inertia::render('Example2');
})->name('example2');

Route::get('/loans/create', [LoanController::class, 'create'])->name('loans.create');

Route::get('/confirmed', function () {
    return Inertia::render('Confirmed');
})->name('confirmed');

Route::get('/document-upload', [DocumentUploadController::class, 'show'])->name('UploadDocuments');

Route::get('/admin/register', function() {
    return Inertia::render('AdminRegister');
});

Route::get('/dashboard', [LoanController::class, 'show'])
    ->can('viewAny', Loan::class)
    ->name('dashboard');


Route::get('/dashboard', [UserController::class, 'show'])
    ->can('viewAny', Loan::class)
    ->name('dashboard');


// testing local routes
if (app()->environment('local'))
{
    Route::get('/users/{user}/cloak', function (User $user) {
        Auth::login($user);
        return redirect('/');
    });
}


Route::delete('/loans/{loan}', [LoanController::class, 'destroy']);
Route::delete('/users/{user}', [UserController::class, 'destroy']);
