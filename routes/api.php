<?php

use App\Http\Controllers\Api\ContactFormController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('test', function(){
//     return [
//         'name' => "ele",
//         'surname' => "Rugg"
//     ];
// });

Route::get('projects', [ProjectController::class, 'index']);
Route::get('projects/{slug}', [ProjectController::class, 'show']);

// /api/contact-form
Route::post('contact-form', [ContactFormController::class, 'email']);