<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function __construct()
    {
        if (!request()->ajax()) {
            if (!auth()->user()) {
                exit('Cannot Access Directly >.<');
            }
            exit('Cannot Access Directly >.<');
        }
    }
    public function mechanic()
    {
        return datatables()->of(\App\Models\Mechanic::query())->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = "<a class='btn btn-icon waves-effect btn-warning' href='javascript:;' onclick='edit(" . $row['id'] . ")'><i class='fa fa-edit''></i></a> ";
                $actionBtn .= "<a class='btn btn-icon waves-effect btn-danger' href='javascript:;' onclick='hapus(" . $row['id'] . ")'><i class='fa fa-trash''></i></a>";
                return $actionBtn;
            })->rawColumns(['action'])->make(true);
    }
    public function getMechanic(Request $request)
    {
        try {
            $validate = $this->validate($request, [
                'id' => 'required'
            ], [
                'id.required' => 'Terjadi kesalahan aplikasi'
            ]);
            $data = Mechanic::where('id', $validate['id'])->first();
            return response()->json([
                'error' => false,
                'message' => 'Berhasil',
                'data' => $data
            ]);
        } catch (\ErrorException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}
