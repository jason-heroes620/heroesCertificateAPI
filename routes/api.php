<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PartnersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\CertificateController;

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

Route::group(['middleware' => 'XSS'], function () {

    Route::post('signin', [AuthController::class, 'signin']);
    Route::post('adminsignin', [AuthController::class, 'adminsignin']);
    Route::post('signup', [AuthController::class, 'signup']);

    Route::get('partners/{id?}', [PartnersController::class, 'partners']);

    Route::get('generateQRCode/{name?}', [QrCodeController::class, 'generateQRCode']);

    Route::post('generateCertificate', [CertificateController::class, 'generateCertificate']);
    // Route::middleware('auth:sanctum')->group(function() {
    //     Route::resource('partners', PartnersController::class);
    // });

    #### test functions #####
    // Route::get('getPartnerImage/{id}', [CertificateController::class, 'getPartnerImage']);
});
