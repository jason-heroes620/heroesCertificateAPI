<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index()
    {
        $data['title'] = 'heroes';
        $data['name'] = session('customer_name');
        $data['body'] = 'heroes';
        $data['voucher_code'] = "HEROES10";

        return view('email', $data);
    }
}
