<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

use Juzaweb\Modules\Contact\Http\Controllers\ContactController;
use Juzaweb\Modules\Core\Facades\RouteResource;

RouteResource::admin('contacts', ContactController::class)
    ->except(['store', 'create', 'destroy']);
