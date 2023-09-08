<?php

use App\Http\Controllers\ChambreController;
use App\Http\Controllers\ChambreUserController;
use Illuminate\Support\Facades\Route;



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

Route::view('/', "welcome", ["name" => "Mustafa"]);
Route::resource("/chambres", ChambreController::class);
Route::delete('/chambres/detach/{chambre}/{user}', [ChambreUserController::class, "detachUser"])->name("chambres.detach");
