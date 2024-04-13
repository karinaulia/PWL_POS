<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\PenjualanDetailModel;
use App\Models\PenjualanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PenjualanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Penjualan',
            'list' => ['Home', 'Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar penjualan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'penjualan';

        $user = UserModel::all();

        return view('penjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $penjualans = PenjualanModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal')
            ->with('user');

        if ($request->user_id) {
            $penjualans->where('user_id', $request->user_id);
        }

        return DataTables::of($penjualans)
            ->addIndexColumn()
            ->addColumn('total_barang', function ($penjualan) {
                $total_barang = PenjualanDetailModel::where('penjualan_id', $penjualan->penjualan_id)
                    ->sum('jumlah');
                return $total_barang;
            })
            ->addColumn('total_harga', function ($penjualan) {
                $total_harga = PenjualanDetailModel::select('penjualan_id')
                    ->where('penjualan_id', $penjualan->penjualan_id)
                    ->selectRaw('sum(harga) as total_harga')
                    ->groupBy('penjualan_id')
                    ->first();
                return $total_harga ? $total_harga->total_harga : 0;
            })
            ->addColumn('aksi', function ($penjualan) {
                $btn = '<a href="' . url('/penjualan/' . $penjualan->penjualan_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/penjualan/' . $penjualan->penjualan_id . '/edit') . '"class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' .
                    url('/penjualan/' . $penjualan->penjualan_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Penjualan',
            'list' => ['Home', 'Penjualan', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah penjualan baru'
        ];

        $pageBarang = (object) [
            'title' => 'Data Barang'
        ];

        $user = UserModel::all();
        $barang = BarangModel::all();
        $activeMenu = 'penjualan';

        return view('penjualan.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'pageBarang' => $pageBarang, 'user' => $user, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'pembeli' => 'required|string|max:50',
            'penjualan_tanggal' => 'required|date',
            'barang' => 'required|array',
            'jumlah' => 'required|array',
            'harga' => 'required|array',
        ]);

        $kode_penjualan_terakhir = PenjualanModel::select('penjualan_kode')
            ->orderBy('penjualan_id', 'desc')
            ->first();

        if (!$kode_penjualan_terakhir) {
            $kode_penjualan = 'JL0001';
        } else {
            $kode_penjualan = 'JL' . sprintf('%05d', substr($kode_penjualan_terakhir->penjualan_kode, 2) + 1);
        }

        PenjualanModel::create([
            'user_id' => $request->user_id,
            'penjualan_kode' => $kode_penjualan,
            'penjualan_tanggal' => $request->penjualan_tanggal,
            'pembeli' => $request->pembeli,
            'harga_total' => $request->harga_total
        ]);

        $penjualan_id = PenjualanModel::select('penjualan_id')
            ->where('penjualan_kode', $kode_penjualan)
            ->first();

        for ($i = 0; $i < count($request->barang); $i++) {
            PenjualanDetailModel::create([
                'penjualan_id' => $penjualan_id->penjualan_id,
                'barang_id' => $request->barang[$i],
                'jumlah' => $request->jumlah[$i],
                'harga' => $request->harga[$i]
            ]);
        }

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $penjualanDetail = PenjualanDetailModel::with(['barang', 'penjualan'])
            ->where('penjualan_id', $id)
            ->get();

        $breadcrumb = (object) [
            'title' => 'Detail Penjualan',
            'list' => ['Home', 'Penjualan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail penjualan'
        ];

        $activeMenu = 'penjualanDetail';

        return view('penjualan.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penjualanDetail' => $penjualanDetail, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $penjualan = PenjualanModel::find($id);
        $user = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Penjualan',
            'list' => ['Home', 'Penjualan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit penjualan'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penjualan' => $penjualan, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'penjualan_kode' => 'required|string|min:3|unique:t_penjualan,penjualan_kode,' . $id . ',penjualan_kode',
            'pembeli' => 'required|string|max:100',
            'penjualan_tanggal' => 'required|date',
            'user_id' => 'required|integer'
        ]);

        PenjualanModel::find($id)->update([
            'penjualan_kode' => $request->penjualan_kode,
            'pembeli' => $request->pembeli,
            'penjualan_tanggal' => $request->penjualan_tanggal,
            'user_id' => $request->user_id
        ]);

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil diubah');
    }

    public function destroy(string $id)
    {
        $penjualanDetail = PenjualanDetailModel::where('penjualan_id', $id);

        foreach ($penjualanDetail->get() as $detail) {
            $detail->delete();
        }

        $check = PenjualanModel::find($id);
        if (!$check) {
            return redirect('/penjualan')->with('error', 'Data penjualan tidak ditemukan');
        }

        try {
            penjualanModel::destroy($id);
            return redirect('/penjualan')->with('success', 'Data penjualan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/penjualan')->with('error', 'Data penjualan gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
