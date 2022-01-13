<?php

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

//Route::middleware('authCheck')->get('/transaction', function (Request $request) {
////    return $request->user();
//    return response()->json(['message' => 'You are authenticated!'], 200);
//});

Route::get('/transaction', [\App\Http\Controllers\api\v1\TransactionController::class,'getAllTransactions'])->middleware('authCheck');


