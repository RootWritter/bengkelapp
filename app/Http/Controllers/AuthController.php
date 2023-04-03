<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_page()
    {
        $data = [
            'page' => 'Masuk'
        ];
        return view('auth.login', $data);
    }
    public function login(Request $request)
    {
        try {
            $validate = $this->validate($request, [
                'email' => 'required',
                'password' => 'required'
            ], [
                'email.required' => 'Email Wajib di isi',
                'password.required' => 'Password Wajib di isi'
            ]);
            if (Auth::attempt($validate, true)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Berhasil Login'
                ]);
            } else {
                throw new \ErrorException('Tidak dapat memverifikasi email & password anda');
            }
        } catch (\ErrorException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
