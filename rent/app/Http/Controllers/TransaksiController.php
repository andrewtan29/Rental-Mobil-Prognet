<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    public function createView()
    {
        $mobils = Mobil::where('status', 'tersedia')->get();
        $pelanggans = Pelanggan::all();

        return view('transaksi.create', compact('mobils', 'pelanggans'));
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id',
            'id_mobil' => 'required|exists:mobil,id',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date',
        ], [
            'id_pelanggan.required' => 'Pelanggan harus diisi',
            'id_pelanggan.exists' => 'Pelanggan tidak ditemukan',
            'id_mobil.required' => 'Mobil harus diisi',
            'id_mobil.exists' => 'Mobil tidak ditemukan',
            'tanggal_sewa.required' => 'Tanggal sewa harus diisi',
            'tanggal_sewa.date' => 'Tanggal sewa harus berupa tanggal',
            'tanggal_kembali.required' => 'Tanggal kembali harus diisi',
            'tanggal_kembali.date' => 'Tanggal kembali harus berupa tanggal',
        ]);

        // Convert dates to MySQL format
        $data['tanggal_sewa'] = date('Y-m-d', strtotime($data['tanggal_sewa']));
        $data['tanggal_kembali'] = date('Y-m-d', strtotime($data['tanggal_kembali']));

        // Calculate total harga = harga sewa * jumlah hari
        $mobil = Mobil::find($data['id_mobil']);
        $tanggal_sewa = strtotime($data['tanggal_sewa']);
        $tanggal_kembali = strtotime($data['tanggal_kembali']);
        $jumlah_hari = ($tanggal_kembali - $tanggal_sewa) / (60 * 60 * 24);
        $total_harga = $mobil->harga_sewa * $jumlah_hari;

        if ($mobil->status !== 'tersedia') {
            throw new \Exception('Mobil tidak tersedia');
        }

        // kode transaksi = idpelanggan-idmobil-tanggalsewa-tanggalkembali-randomstring
        $kode_transaksi = $data['id_pelanggan'] . 'X' . $data['id_mobil'] . 'Y' . $data['tanggal_sewa'] . 'Z' . $data['tanggal_kembali'] . '-' . strtoupper(substr(md5(uniqid()), 0, 5));

        // Create new transaksi
        $transaksi = new Transaksi();
        $transaksi->kode_transaksi = $kode_transaksi;
        $transaksi->id_pelanggan = $data['id_pelanggan'];
        $transaksi->id_mobil = $data['id_mobil'];
        $transaksi->tanggal_sewa = $data['tanggal_sewa'];
        $transaksi->tanggal_kembali = $data['tanggal_kembali'];
        $transaksi->id_admin = Auth::id();
        $transaksi->harga_sewa = $mobil->harga_sewa;
        $transaksi->total_harga = $total_harga;
        $transaksi->status_transaksi = 'sedang disewa';
        $transaksi->save();

        // Update mobil status to "sedang disewa"
        $mobil->status = 'sedang disewa';
        $mobil->save();

        return redirect()->route('dashboard')->with('success', 'Transaksi berhasil dibuat');
    }

    function delete($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->delete();

        return redirect()->route('dashboard')->with('success', 'Transaksi berhasil dihapus');
    }

    function complete($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->status_transaksi = 'selesai';
        $transaksi->save();

        // Update mobil status to "tersedia"
        $mobil = Mobil::find($transaksi->id_mobil);
        $mobil->status = 'tersedia';
        $mobil->save();

        return redirect()->route('dashboard')->with('success', 'Transaksi berhasil diselesaikan');
    }

    public function cetakNota($id)
    {
        $transaksi = Transaksi::with('mobil', 'pelanggan')->findOrFail($id);

        $pdf = Pdf::loadView('transaksi.nota', compact('transaksi'));

        return $pdf->stream('nota-transaksi-' . $transaksi->id . '.pdf');
    }

}
