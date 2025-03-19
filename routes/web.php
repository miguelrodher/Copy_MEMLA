<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectMemlaController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//Route::post('/projectMemla', [ProjectMemlaController::class, 'store'])->name('projectMemla.store');
//Route::put('/projectMemla/{projectMemla}', [ProjectMemlaController::class, 'update'])->name('projectMemla.update');





Route::get('/selection-study-topic_spanish',function (){

    return view("memla.phase1_spanish.index");
});
//Route::post('/create_project', [\App\Http\Controllers\Phase1Controller::class, 'store'])->name('project.store');
Route::get('/introduction-to-machine-learning',function (){

    return view("memla.phase0.index");
});

//Route::post('/selection-study-topic', [App\Http\Controllers\Phase1Controller::class, 'store']);


Route::resource('/selection-study-topic',App\Http\Controllers\Phase1Controller::class);
Route::post("provisionalproject", [\App\Http\Controllers\Phase1Controller::class, "provisional_project"])->name("provisionalproject");


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('/data-collection',\App\Http\Controllers\Phase2Controller::class);

    Route::resource('/project_memla',App\Http\Controllers\ProjectMemlaController::class);
    Route::get('/project-memla/create/{id}', [ProjectMemlaController::class, 'create'])->name('project_memla.create');
    Route::delete('project_memla.restar_test_project/{id}', [ProjectMemlaController::class, 'restar_test_project'])->name('project_memla.restar_test_project');


    Route::resource('/computational-environment', App\Http\Controllers\Phase3Controller::class);
    Route::get('/computational-environment/{id}/{rows}', [App\Http\Controllers\Phase3Controller::class, 'show']);

    Route::resource('/implementation-algorithm', App\Http\Controllers\Phase4Controller::class);
    Route::get('/implementation-algorithm/{id}/{rows}', [App\Http\Controllers\Phase4Controller::class,'show']);

    Route::resource('/knowledge-application', App\Http\Controllers\Phase5Controller::class);
    Route::get('/knowledge-application/{id}/{rows}', [App\Http\Controllers\Phase5Controller::class, 'show']);

    Route::get("load_file",[\App\Http\Controllers\Api\Phase2Controller::class,"index"])->name("load_file");
    Route::post("/selection-study-topic/save_data", [App\Http\Controllers\Phase1Controller::class,"saveData"]);

    Route::get("printpdf/phase1/{project}",[\App\Http\Controllers\MakePDFController::class, 'phase1']);

    //url for paper test
    Route::get('printpdf/backup/',function (){
        return redirect("printpdf/phase1/1");
    });

    Route::get('/phase2/{id_project}', [\App\Http\Controllers\Phase2Controller::class, 'show'])->name('phase2.show');

});




Route::get("/test_dashboard",function(){
    return view("layouts.dashboard");
});


require __DIR__.'/auth.php';
