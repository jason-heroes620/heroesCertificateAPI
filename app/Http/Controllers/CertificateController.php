<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use VerumConsilium\Browsershot\Facades\PDF;
use Mail;

class CertificateController extends Controller
{
    //
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
        $data['name'] = $post['name'];
        $partner = explode('-', (base64_decode($post['partner'])));
        $data['partner'] = $partner[1];
        $data['email'] = $post['email'];
        $data['title'] = "Heroes - Certificate of Participation (" . $partner[1] . ")";
        $data['body'] = "Thank you for your participation on the workshop organized by "
            . $partner[1] . ". Attached is you certificate of participation.";

        $pdfFile = public_path('pdf/' . str_replace(' ', '', $post['name']) . '_' . time() . '.pdf');
        PDF::loadView('certificate', $data)
            ->setOption('portrait', true)
            ->showBackground()
            ->format('A4')
            ->pages(1)
            ->save($pdfFile);

        Mail::send('email', $data, function ($message) use ($data, $pdfFile) {
            $message->to($data["email"])
                ->subject($data["title"])
                ->attach($pdfFile);
        });
        return 'done';
        // return $pdf->download('pdf_file.pdf');
    }

    public function previewCertificate()
    {
        $data['name'] = 'Jason Wong';
        $data['partner'] = 'Activkix';

        // $pdfFile = public_path('pdf/' . str_replace(' ', '', $data['name']) . '_' . time() . '.pdf');
        // PDF::loadView('certificate', $data)
        //     ->setOption('portrait', true)
        //     ->stream($pdfFile);
        return view('certificate', $data);
    }
}
