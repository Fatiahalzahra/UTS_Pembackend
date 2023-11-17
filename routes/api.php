<?php
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
# mengimport controller Pasien covid
use App\Http\Controllers\PasiencovidController;


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

#method get
Route::get("/pasiencovid", [PasiencovidController::class, 'index']);
Route::get('/pasiencovid/{id}', [PasiencovidControllerr::class, 'show']);

#method post
Route::post("/pasiencovid", [PasiencovidController::class, 'store']);

#method put
Route::put('/pasiencovid/{id}', [PasiencovidController::class, 'update']);
#method delete
Route::delete('/pasiencovid/{id}', [PasiencovidController::class, 'destroy']);

#membuat route untuk register dan login
Route::get('/search_data_pasien', [PasiencovidController::class,'search_data_pasien']);
Route::get('/positive', [PasiencovidController::class,'positive']);
Route::get('/recovered', [PasiencovidController::class,'recovered']);
Route::get('/dead', [PasiencovidController::class,'dead']);
