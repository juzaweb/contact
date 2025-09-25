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

Route::post('contact', [\Juzaweb\Modules\Contact\Http\Controllers\ContactController::class, 'store'])
    ->name('contact.store')
    ->middleware([\Juzaweb\Core\Http\Middleware\Captcha::class]);
