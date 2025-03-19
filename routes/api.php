<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/test_api}',function(){
    return 'memla.phase3.index';
});

Route::middleware('auth')->group(function () {

});


Route::get("prueba_801", [\App\Http\Controllers\Api\TestController::class,"getActividades"]);

/** MEMLA ROUTES
 *
 * ***/

Route::get("load_file",[\App\Http\Controllers\Api\Phase2Controller::class,"index"])->name("load_file");
Route::get("load_outliers", [\App\Http\Controllers\Api\Phase2Controller::class, "loadoutliers"])->name("load_outliers");

Route::get("main", [\App\Http\Controllers\Api\Phase2Controller::class, "mainhola"])->name("main");
Route::get("change_value",[\App\Http\Controllers\Api\Phase2Controller::class,"changeValue"])->name("change_value");
Route::get("delete_duplicate", [\App\Http\Controllers\Api\Phase2Controller::class, "deleteValues"])->name("delete_duplicate");
Route::get("delete_columns", [\App\Http\Controllers\Api\Phase2Controller::class, "deleteColumns"])->name("delete_columns");
Route::get("encode_columns_o", [\App\Http\Controllers\Api\Phase2Controller::class, "encode_ordinal"])->name("encode_columns_o");
Route::get("encode_columns_n", [\App\Http\Controllers\Api\Phase2Controller::class, "encode_nominal"])->name("encode_columns_n");
Route::get("handle_outliers", [\App\Http\Controllers\Api\Phase2Controller::class, "handleOutliers"])->name("handle_outliers");
Route::get("save_target", [\App\Http\Controllers\Api\Phase2Controller::class, "update"])->name("save_target");

Route::get("split_data", [\App\Http\Controllers\Api\Phase3Controller::class, "splitData"])->name("split_data");
Route::get("split_representative", [\App\Http\Controllers\Api\Phase3Controller::class, "splitRepresentative"])->name("split_representative");
Route::get("split_f_fold", [\App\Http\Controllers\Api\Phase3Controller::class , "splitKFold"])->name("split_k_fold");

Route::get("train_model", [App\Http\Controllers\Api\Phase4Controller::class, "trainModel"])->name("train_model");
Route::get("save_model", [App\Http\Controllers\Api\Phase4Controller::class, "saveModel"])->name("save_model");

// routes/api.php
/*Route::get('archivo', function () {
    $ruta = storage_path('storage\datasets\0H6FR4HIvZTVXwsbRAkZFmPqA7hnL4zAylYQsiqA.csv');
    if (file_exists($ruta)) {
        return response()->file($ruta);
    }
    return response()->json(['error' => 'Archivo no encontrado'], 404);
});*/
