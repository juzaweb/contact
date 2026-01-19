<?php

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

use Juzaweb\Modules\Contact\Http\Controllers\ContactController;
use Juzaweb\Modules\Core\Http\Middleware\VerifyToken;

Route::post('contact', [ContactController::class, 'store'])
    ->name('contact.store');
