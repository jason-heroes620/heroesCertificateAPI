<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\CertificateController;

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

Route::group(['middleware'=>'XSS'], function () {

    Route::get('/', function () {
        return view('welcome');
    });


    Route::get('/qrcode', [QrCodeController::class, 'index']);
    Route::get('/create', [QrCodeController::class, 'createPDF']);
    
    Route::get('/certificate', [CertificateController::class, 'previewCertificate']);
});