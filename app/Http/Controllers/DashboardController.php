<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data = [
            'page' => 'Halaman Utama',
            'user' => Auth::user(),
        ];
        return view('dashboard', $data);
    }
    public function cashier()
    {
        $data = [
            'page' => 'Halaman Kasir',
            'user' => Auth::user(),
        ];
        return view('cashier', $data);
    }
}
