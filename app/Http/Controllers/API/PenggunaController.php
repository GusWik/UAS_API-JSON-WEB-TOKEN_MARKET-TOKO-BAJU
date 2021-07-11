<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pengguna;
use Validator;

class PenggunaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>  ['index', 'show']]);
    }

    public function index()
    {
        $penggunas = Pengguna::all();
        return response()->json($penggunas);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_pengguna' => 'required',
            'alamat' => 'required',
            'no_tlp' => 'required'
        ]);
        if ($validate->passes()) {

            $penggunas = Pengguna::create($request->all());
            return response()->json([
                'message' => 'Data Sudah Disimpan',
                'data' => $penggunas
            ]);
        }
        return response()->json([
            'message' => 'Data Gagal Disimpan',
            'data' => $validate->error()->all()
        ]);
    }

    public function show($penggunas)
    {
        $data = Pengguna::where('id_pengguna', $penggunas)->first();
        if (!empty($data)) {
            return $data;
        }
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }
    public function update(Request $request, $penggunas)
    {
        $data = Pengguna::where('id_pengguna', $penggunas)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(), [
                'nama_pengguna' => 'required',
                'alamat' => 'required',
                'no_tlp' => 'required'
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
    public function destroy($penggunas)
    {
        $data = Pengguna::where('id_pengguna', $penggunas)->first();
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
























