<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\ProductCreationController;

// ang kanang mga routes, according to the documentation, gina himo nimo na sila para ma himoan
// nimog name kunohay para later on pwede nimo gamiton ang name pag mag redirect ka or mag 
// call ka ug routes. PLEASE AYAW KALIBOG
// kibali if mag route:get ka for example, ang before sa function is ang blade file nga naka open 
// kamulo tapos ang return is kanang unsa iyang ipa view taposa ng name, name na sa route

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/create-product', function () {
    return view('menu-pricing.create-product');
})->name('create-product');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/dashboard', function () {
    if (!session('user_id')) {
        return redirect()->route('login');
    }
    return view('dashboard');
})->name('dashboard');

use App\Http\Controllers\AuditTrailController;
Route::get('/audit-trail', [AuditTrailController::class, 'index'])->name('audit-trail');

Route::post('/logout', function () {
    session()->forget('user_id');
    session()->regenerate();
    return redirect()->route('login');
})->name('logout');

Route::post('/menu-pricing', [ProductCreationController::class, 'createProduct'])->name('createProduct');
Route::get('/menu-pricing', [ProductCreationController::class, 'read'])->name('menu-pricing');
Route::get('/menu-pricing/{product}/edit', [ProductCreationController::class, 'edit'])->name('edit-product');
Route::put('/menu-pricing/{product}/update', [ProductCreationController::class, 'updateProduct'])->name('update-product');
Route::delete('/menu-pricing/{product}/delete', [ProductCreationController::class, 'deleteProduct'])->name('delete-product');

