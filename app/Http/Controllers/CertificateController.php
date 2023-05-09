<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use VerumConsilium\Browsershot\Facades\PDF;
use Illuminate\Support\Facades\Http;
use App\Mail\CertificateMail;
use Mail;

class CertificateController extends Controller
{
    private $rest;
    private $merchantId;

    public function __construct()
    {
        $this->rest = env('API_BASEURL');
        $this->merchantId = env('MERCHANT_ID');
    }

    public function generateCertificate(Request $request)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post = $request->post();
            $result = $this->certificate($post);
            return $this->sendResponse($result, '');
        } else {
            return $this->sendError('', ['error' => 'Allowed headers POST'], 405);
        }
    }

    public function certificate($post)
    {
        // $data['name'] = $post['name'];
        $data['name'] = session('customer_name');
        $partner = explode('-', (base64_decode($post['partner'])));
        $partner_id = $partner[0];
        $data['partner_image'] = $this->getPartnerImage($partner_id);
        $data['partner'] = $partner[1];
        $data['email'] = $post['email'];
        $data['subject'] = "Heroes - Certificate of Participation (" . $partner[1] . ")";
        $data['body'] = "Thank you for your participation on the workshop organized by "
            . $partner[1] . ". Attached is you certificate of participation.";

        $data['voucher_code'] = "HEROES10";

        $pdfFile = public_path('pdf/' . str_replace(' ', '', $post['name']) . '_' . time() . '.pdf');
        PDF::loadView('certificate', $data)
            ->setOption('portrait', true)
            ->showBackground()
            ->format('A4')
            ->pages(1)
            ->save($pdfFile);

        $data['pdf'] = $pdfFile;
        // Mail::send('email', $data, function ($message) use ($data, $pdfFile) {
        //     $message->to($data["email"])
        //         ->subject($data["title"])
        //         ->attach($pdfFile);
        // });

        Mail::to($data['email'])->send(new CertificateMail($data));

        return 'done';
    }

    public function previewCertificate()
    {
        $data['name'] = 'Jason Wong';
        $data['partner'] = 'Activkix';
        $data['partner_image'] = 'https://heroes.a2hosted.com/image/catalog/Merchant%20logo/Logo.png';
        // $pdfFile = public_path('pdf/' . str_replace(' ', '', $data['name']) . '_' . time() . '.pdf');
        // PDF::loadView('certificate', $data)
        //     ->setOption('portrait', true)
        //     ->stream($pdfFile);
        return view('certificate', $data);
    }

    public function getPartnerImage($partnerId)
    {
        $response = Http::withHeaders([
            'X-Oc-Merchant-Id' => $this->merchantId
        ])->get($this->rest . 'manufacturers/' . $partnerId);

        return $response['data']['image'];
    }

    public function sendDemoMail()
    {
        $email = 'jason820620@gmail.com';

        $maildata = [
            'subject' => "Heroes - Certificate of Participation (Sample)",
            'title' => 'Laravel Mail Sending Example with Markdown',
            'url' => 'https://www.positronx.io',
            'body' => "Thank you for your participation on the workshop organized by sample. Attached is you certificate of participation.",

        ];

        Mail::to($email)->send(new CertificateMail($maildata));

        dd("Mail has been sent successfully");
    }
}
