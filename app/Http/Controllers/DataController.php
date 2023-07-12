<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use App\Models\Part;
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
            ->editColumn('photo', function ($row) {
                if ($row['photo'] == "default.png") {
                    $img_url = asset('default.png');
                } else {
                    $img_url = asset('mechanic/' . $row['photo']);
                }
                return "<img src='$img_url' class='img-thumbnail'>";
            })->addColumn('action', function ($row) {
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
    public function sparepart()
    {
        return datatables()->of(\App\Models\Part::query())->addIndexColumn()->editColumn('photo', function ($row) {
            if ($row['photo'] == "default.png") {
                $img_url = asset('default.png');
            } else {
                $img_url = asset('sparepart/' . $row['photo']);
            }
            return "<img src='$img_url' class='img-thumbnail'>";
        })->editColumn('price', function ($row) {
            return rupiah($row['price']);
        })->addColumn('action', function ($row) {
            $actionBtn = "<a class='btn btn-icon waves-effect btn-warning' href='javascript:;' onclick='edit(" . $row['id'] . ")'><i class='fa fa-edit''></i></a> ";
            $actionBtn .= "<a class='btn btn-icon waves-effect btn-danger' href='javascript:;' onclick='hapus(" . $row['id'] . ")'><i class='fa fa-trash''></i></a>";
            return $actionBtn;
        })->rawColumns(['action', 'photo'])->make(true);
    }
    public function getSparepart(Request $request)
    {
        try {
            $validate = $this->validate($request, [
                'id' => 'required'
            ], [
                'id.required' => 'Terjadi kesalahan aplikasi'
            ]);
            $data = \App\Models\Part::where('id', $validate['id'])->first();
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
    public function fetchParts(Request $request)
    {
        $data = Part::query();

        if ($request['search']) {
            $data->where('name', 'LIKE', "%" . $request['search'] . "%")->orWhere('code', 'LIKE', "%" . $request['search'] . "%");
        }
        return response()->json([
            'error' => false,
            'message' => 'Berhasil',
            'data' => $data->get()
        ]);
    }
}
