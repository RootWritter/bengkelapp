<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AjaxController extends Controller
{
    public function mechanic(Request $request)
    {
        try {
            if ($request->action == "add") {
                $validate = $this->validate($request, [
                    'name' => 'required',
                ], [
                    'name.required' => 'Anda belum memasukan nama Mekanik'
                ]);
                if ($request->hasFile('photo')) {
                    $images = $request->file('photo');
                    $images->move(public_path('mechanic/'), $images->getClientOriginalName());
                    $validate['photo'] = $images->getClientOriginalName();
                } else {
                    $validate['photo'] = 'default.png';
                }
                $insert = Mechanic::create($validate);
                if (!$insert) throw new \ErrorException('Tidak dapat Menambahkan Data Mekanik');
                $message = "Berhasil Menambahkan Data Mekanik";
            } else if ($request->action == "edit") {
                $validate = $this->validate($request, [
                    'name' => 'required',
                ], [
                    'name.required' => 'Anda belum memasukan nama Mekanik'
                ]);
                $getOld = Mechanic::where('id', $request->id)->first();
                if ($request->hasFile('photo')) {
                    unlink(public_path('mechanic/' . $getOld['photo']));
                    $images = $request->file('photo');
                    $images->move(public_path('mechanic/'), $images->getClientOriginalName());
                    $validate['photo'] = $images->getClientOriginalName();
                } else {
                    $validate['photo'] = $getOld['photo'];
                }
                $insert = Mechanic::where('id', $request->id)->update($validate);
                if (!$insert) throw new \ErrorException('Tidak dapat Mengupdate Data Mekanik');
                $message = "Berhasil Mengupdate Data Mekanik";
            } else if ($request->action == "hapus") {
                $getOld = Mechanic::where('id', $request->id)->first();
                if ($getOld['photo'] !== "default.png") {
                    unlink(public_path('mechanic/' . $getOld['photo']));
                }
                $insert = Mechanic::where('id', $request->id)->delete();
                if (!$insert) throw new \ErrorException('Tidak dapat Menghapus Data Mekanik');
                $message = "Berhasil Menghapus Data Mekanik";
            }
            return response()->json([
                'error' => false,
                'message' => $message
            ]);
        } catch (\ErrorException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function sperpart(Request $request)
    {
        try {
            if ($request->action == "add") {
                $validate = $this->validate($request, [
                    'brand' => 'required',
                    'name' => 'required',
                    'code' => 'required',
                    'price' => 'required',
                    'stock' => 'required',
                ], [
                    'name.required' => 'Anda belum memasukan Nama Sperpart',
                    'brand.required' => 'Anda belum memasukan Brand Sperpart',
                    'code.required' => 'Anda belum memasukan Code Sperpart',
                    'price.required' => 'Anda belum memasukan Harga Sperpart',
                    'stock.required' => 'Anda belum memasukan Stock Sperpart'
                ]);
                if ($request->hasFile('photo')) {
                    $images = $request->file('photo');
                    $images->move(public_path('sperpart/'), $images->getClientOriginalName());
                    $validate['photo'] = $images->getClientOriginalName();
                } else {
                    $validate['photo'] = 'default.png';
                }
                $validate['uuid'] = Str::uuid();
                $insert = Part::create($validate);
                if (!$insert) throw new \ErrorException('Tidak dapat Menambahkan Data Sperpart');
                $message = "Berhasil Menambahkan Data Sperpart";
            } else if ($request->action == "edit") {
                $validate = $this->validate($request, [
                    'brand' => 'required',
                    'name' => 'required',
                    'code' => 'required',
                    'price' => 'required',
                    'stock' => 'required',
                ], [
                    'name.required' => 'Anda belum memasukan Nama Sperpart',
                    'brand.required' => 'Anda belum memasukan Brand Sperpart',
                    'code.required' => 'Anda belum memasukan Code Sperpart',
                    'price.required' => 'Anda belum memasukan Harga Sperpart',
                    'stock.required' => 'Anda belum memasukan Stock Sperpart'
                ]);
                $getOld = Part::where('id', $request->id)->first();
                if ($request->hasFile('photo')) {
                    unlink(public_path('sperpart/' . $getOld['photo']));
                    $images = $request->file('photo');
                    $images->move(public_path('sperpart/'), $images->getClientOriginalName());
                    $validate['photo'] = $images->getClientOriginalName();
                } else {
                    $validate['photo'] = $getOld['photo'];
                }
                $insert = Part::where('id', $request->id)->update($validate);
                if (!$insert) throw new \ErrorException('Tidak dapat Mengupdate Data Sperpart');
                $message = "Berhasil Mengupdate Data Sperpart";
            } else if ($request->action == "hapus") {
                $getOld = Part::where('id', $request->id)->first();
                if ($getOld['photo'] !== "default.png") {
                    unlink(public_path('sperpart/' . $getOld['photo']));
                }
                $insert = Part::where('id', $request->id)->delete();
                if (!$insert) throw new \ErrorException('Tidak dapat Menghapus Data Sperpart');
                $message = "Berhasil Menghapus Data Sperpart";
            }
            return response()->json([
                'error' => false,
                'message' => $message
            ]);
        } catch (\ErrorException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}
