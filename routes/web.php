<?php

use App\Http\Controllers\ContactController;
use App\Mail\ContactedMessage;
use App\Models\Project;
use Inertia\Inertia;
use App\Models\Skill;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'skills' => Skill::all(),
        'projects' => Project::all(),
    ]);
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     })->name('dashboard');
// });

Route::post('contact', [ContactController::class, 'contact'])->name('contact');

Route::get('/test', function () {
    return new ContactedMessage('test@test.com', 'Just a test');
});
