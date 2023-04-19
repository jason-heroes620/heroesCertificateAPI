<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function index()
    {
      return view('qrcode');
    }

    public function generateQRCode(Request $request)
    {
      if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $result = $this->getQR($request->name);
        return response($result, 200)->header('Content-Type', 'image/svg+xml');
      } else {
        return $this->sendError('', ['error'=>'Allowed headers GET'], 405);
      }
    }

    public function getQR($name)
    {
      $http  = env('CERT_SERVER').'/signin/'.$name;
      // $merchantName = end(explode('-', base64_decode($name)));
      $name = base64_decode($name);
      $exName = explode('-', $name);
      $merchantName = $exName[1];
      $qr = QrCode::generate($http);
      QrCode::generate($http, public_path('images/'.$merchantName.'.png'));

      return $qr;
    }
}
