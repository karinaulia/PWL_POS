<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PenjualanModel;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    public function index()
    {
        return PenjualanModel::with([
            'penjualan_details' => ['barang']
        ])->get();
    }

    public function store(Request $request)
    {
        $penjualan = PenjualanModel::create($request->all());
        return response()->json($penjualan, 201);
    }

    public function show(PenjualanModel $penjualan)
    {
        return $penjualan;
    }

    public function update(Request $request, PenjualanModel $penjualan)
    {
        $penjualan->update($request->all());
        return PenjualanModel::find($penjualan);
    }

    public function destroy(PenjualanModel $penjualan)
    {
        $penjualan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data terhapus'
        ]);
    }
}
