<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Response;

class PartnersController extends Controller
{
    private $rest;
    private $merchantId;
    
    public function __construct()
    {
        $this->rest = env('API_BASEURL');
        $this->merchantId = env('MERCHANT_ID');
    }

    // List Partners
    public function partners(Request $request)
    {
        if (isset($request->id)) {
            $response = $this->getPartner($request);
        }else {
            $response = $this->getPartnerList();
        }

        if ($response->ok()) {
            $data = json_decode($response->body());
            return $this->sendResponse($data->data, '');
        } else {
            $data = json_decode($response->body());
            return $this->sendError($data->error, ['error'=> $data->error]);
        }
    }

    private function getPartnerList()
    {
        return Http::withHeaders([
            'X-Oc-Merchant-Id' => $this->merchantId
        ])->get($this->rest.'manufacturers');
    }

    private function getPartner($request)
    {
        return Http::withHeaders([
            'X-Oc-Merchant-Id' => $this->merchantId
        ])->get($this->rest.'manufacturers/'.$request['id']);
    }

    private function partnerQRCodeById($request)
    {
        $response = Http::withHeaders([
            'X-Oc-Merchant-Id' => $this->merchantId
        ])->get($this->rest.'manufacturers/'.$request['id']);

        $partner_id = $response->json();
    }
}
