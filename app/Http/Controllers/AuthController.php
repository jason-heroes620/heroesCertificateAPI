<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    private $rest;
    private $restAdmin;
    private $merchantId;
    private $adminId;

    public function __construct()
    {
        $this->rest = env('API_BASEURL');
        $this->restAdmin = env('API_ADMIN_BASEURL');
        $this->merchantId = env('MERCHANT_ID');
        $this->adminId = env('ADMIN_ID');
    }

    public function signin(Request $request)
    {
        $headers = $request->header();
        $key = 'x-oc-session';
        $session = $headers[$key];
        $response = Http::withHeaders([
            'X-Oc-Merchant-Id' => $this->merchantId,
            'X-Oc-Session' => $session,
        ])->post($this->rest . "login", [
            'email' => $request->email,
            'password' => $request->password
        ]);
        //print_r($response);
        if ($response->ok()) {
            $authUser = User::select('firstname', 'lastname', 'email')
                ->from('customer')
                ->where('email', $request->email)
                ->first();
            //print_r($authUser);
            $success['token'] =  $authUser->createToken('HeroesCertificate')->plainTextToken;
            $success['firstname'] =  $authUser->firstname;
            $success['lastname'] =  $authUser->lastname;
            $success['email'] =  $authUser->email;

            $request->session()->put('user', $authUser->email);
            $request->session()->put('name', $authUser->firstname);

            return $this->sendResponse($success, 'User signed in');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised'], $response->status());
        }
    }

    public function adminsignin(Request $request)
    {
        $headers = $request->header();
        $key = 'x-oc-session';
        $session = $headers[$key];
        $response = Http::withHeaders([
            'X-Oc-Restadmin-Id' => $this->adminId,
            'X-Oc-Session' => $session
        ])->post($this->restAdmin . "login", [
            'username' => $request->username,
            'password' => $request->password
        ]);
        if ($response->ok()) {
            $authUser = User::select('firstname', 'lastname', 'email')
                ->from('user')
                ->where('username', $request->username)
                ->first();
            $success['token'] =  $authUser->createToken('HeroesAdmin')->plainTextToken;

            return $this->sendResponse($success, 'User signed in');
        } else {

            return $this->sendError($response->body(), ['error' => 'Unauthorised']);
        }
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyAuthApp')->plainTextToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User created successfully.');
    }
}
