<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $totalMobil = Mobil::count();
        $totalPelanggan = Pelanggan::count();
        $totalTransaksi = Transaksi::count();
        $totalHargaTransaksi = Transaksi::sum('total_harga');

        $search = $request->input('search');
        $status = $request->input('status');

        $transaksisQuery = Transaksi::with('mobil', 'pelanggan');

        if ($status) {
            $transaksisQuery->where('status_transaksi', $status);
        }

        if ($search) {
            $transaksisQuery->where(function ($query) use ($search) {
                $query->orWhere('tanggal_sewa', 'like', '%' . $search . '%')
                    ->orWhere('tanggal_kembali', 'like', '%' . $search . '%')
                    ->orWhere('kode_transaksi', 'like', '%' . $search . '%')
                    ->orWhereHas('mobil', function ($query) use ($search) {
                        $query->where('plat_nomor', 'like', '%' . $search . '%')
                            ->orWhere('nama', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('pelanggan', function ($query) use ($search) {
                        $query->where('nama', 'like', '%' . $search . '%');
                    });
            });
        }

        $transaksis = $transaksisQuery->orderBy('created_at', 'desc')->get();

        return view('dashboard', [
            'totalMobil' => $totalMobil,
            'totalPelanggan' => $totalPelanggan,
            'totalTransaksi' => $totalTransaksi,
            'transaksis' => $transaksis,
            'totalHargaTransaksi' => $totalHargaTransaksi,
        ]);
    }
}
