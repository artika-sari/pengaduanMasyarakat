<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\landingPageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\KelolaAkunController;

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

Route::get('/login', [UserController::class, 'loginForm'])->name('login.form');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/regis', [UserController::class, 'regis'])->name('regis');
Route::post('/regis/store', [UserController::class, 'createUser'])->name('regis.store');
Route::post('/loginAuth', [UserController::class, 'loginAuth'])->name('loginAuth');
Route::get('/', [landingPageController::class, 'index'])->name('landingPage');
Route::get('/datastaff', [KelolaAkunController::class, 'index'])->name('data.staff');
Route::get('/data/add', [KelolaAkunController::class, 'create'])->name('data.add');
Route::post('/data/add', [KelolaAkunController::class, 'store'])->name('data.add.store');
Route::delete('/data/delete/{id}', [KelolaAkunController::class, 'destroy'])->name('data.delete');
Route::post('/data/reset/{id}', [KelolaAkunController::class, 'Reset'])->name('data.reset');


Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/reports', [ReportController::class, 'index'])->name('reports');
Route::get('/reports/artikel', [ReportController::class, 'artikel'])->name('reports.artikel');
Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');
Route::post('/reports/create', [ReportController::class, 'store'])->name('report.create.store');
Route::get('/reports/show/{id}', [ReportController::class, 'show'])->name('reports.show');
Route::get('/reoprts/viewers/{id}', [ReportController::class, 'viewers'])->name('reports.viewers');
Route::delete('/report/{id}', [ReportController::class, 'destroy'])->name('delete');
Route::post('/comment/store/{id}', [CommentController::class, 'store'])->name('comment.store');
Route::post('/report/voting/{id}', [ReportController::class, 'voting'])->name('report.voting');
Route::get('/dashboard', [ReportController::class, 'dashboard'])->name('dashboard');
Route::get('/monitoring', [ReportController::class, 'monitoring'])->name('monitoring');
Route::get('reports/search', [ReportController::class, 'searchByProvince'])->name('reports.search');
// Route::middleware(['isLogin'])->group(function(){
// });
