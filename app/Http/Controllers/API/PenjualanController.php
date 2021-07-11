<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Penjualan;
use Validator;

class PenjualanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>  ['index', 'show']]);
    }

    public function index(){
        $penjualans = Penjualan::with('Pembeli', 'Barang', 'Pengguna')->get();
        return response()->json($penjualans);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'tgl_penjualan' => 'required',
            'jml_barang' => 'required',
            'total' => 'required',
            'id_pembeli' => 'required',
            'id_barang' => 'required',
            'id_pengguna' => 'required'
        ]);
        if ($validate->passes()) {

            $penjualans = Penjualan::create($request->all());
            return response()->json([
                'message' => 'Data Sudah Disimpan',
                'data' => $penjualans
            ]);
        }
        return response()->json([
            'message' => 'Data Gagal Disimpan',
            'data' => $validate->error()->all()
        ]);
    }

    public function show($penjualans)
    {
        $data = Penjualan::where('id_penjualan', $penjualans)->first();
        if (!empty($data)) {
            return $data;
        }
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }
    public function update(Request $request, $penjualans)
    {
        $data = Penjualan::where('id_penjualan', $penjualans)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(), [
                'tgl_penjualan' => 'required',
                'jml_barang' => 'required',
                'total' => 'required',
                'id_pembeli' => 'required',
                'id_barang' => 'required',
                'id_pengguna' => 'required'
            ]);
            if ($validate->passes()) {
                $data->update($request->all());
                return response()->json([
                    'message' => 'Data Berhasil Disimpan',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Data Gagal Disimpan',
                    'data' => $validate->errors()->all()
                ]);
            }
        }
        return response()->json([
            'message' => 'Data tidak ditemukan'
        ], 404);
    }
    public function destroy($penjualans)
    {
        $data = Penjualan::where('id_penjualan', $penjualans)->first();
        if (empty($data)) {
            return response()->json([
                'message' => 'Data Tidak Ditemukan'
            ], 404);
            # code...
        }

        $data->delete();
        return response()->json([
            'message' => 'Data Berhasil Dihapus'
        ], 200);
    }
}
