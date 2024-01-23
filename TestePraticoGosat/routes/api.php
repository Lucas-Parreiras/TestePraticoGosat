<?php

use App\Http\Controllers\CreditoController;
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

Route::post('/credito', [CreditoController::class, 'show']);
Route::post('/oferta', [CreditoController::class, 'showOffer']);
Route::post('/test', [CreditoController::class, 'offersFormated']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
