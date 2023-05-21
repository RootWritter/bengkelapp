<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterController extends Controller
{
    public function mechanic()
    {
        $data = [
            'page' => 'Management Mekanik',
            'user' => Auth::user(),
        ];
        return view('master.mechanic', $data);
    }
    public function sparepart()
    {
        $data = [
            'page' => 'Management Sparepart',
            'user' => Auth::user(),
        ];
        return view('master.sparepart', $data);
    }
}
