<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status'); 

        $mobilsQuery = Mobil::query();

        if ($search) {
            $mobilsQuery->where(function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('plat_nomor', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%');
            });
        }

        if ($status) {
            $mobilsQuery->where('status', $status);
        }

        $mobils = $mobilsQuery->orderByDesc('created_at')->get();

        return view('mobil.index', compact('mobils'));
    }


    public function createView()
    {
        return view('mobil.create');
    }

    public function editView($id)
    {
        $mobil = Mobil::find($id);
        return view('mobil.edit', compact('mobil'));
    }

    public function create(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'nama' => 'required',
            'harga_sewa' => 'required|numeric|min:0',
            'jumlah' => 'required|numeric',
            'status' => 'required|in:tersedia,tidak tersedia',
            'plat_nomor' => 'required|string|unique:mobil',
        ], [
            'nama.required' => 'Nama mobil harus diisi',
            'harga_sewa.required' => 'Harga sewa harus diisi',
            'harga_sewa.numeric' => 'Harga sewa harus berupa angka',
            'jumlah.required' => 'Jumlah mobil harus diisi',
            'jumlah.numeric' => 'Jumlah mobil harus berupa angka',
            'status.required' => 'Status mobil harus diisi',
            'status.in' => 'Status mobil harus diisi dengan tersedia atau tidak tersedia',
            'plat_nomor.required' => 'Plat nomor harus diisi',
            'plat_nomor.unique' => 'Plat nomor sudah digunakan',
        ]);

        $mobil = new Mobil();
        $mobil->nama = $data['nama'];
        $mobil->harga_sewa = $data['harga_sewa'];
        $mobil->jumlah = $data['jumlah'];
        $mobil->status = $data['status'];
        $mobil->plat_nomor = $data['plat_nomor'];
        $mobil->save();

        return redirect()->route('mobil.index.view')->with('success', 'Mobil berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama' => 'required',
            'harga_sewa' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'status' => 'required|in:tersedia,tidak tersedia',
            'plat_nomor' => 'required|string|unique:mobil,plat_nomor,' . $id,
        ], [
            'nama.required' => 'Nama mobil harus diisi',
            'harga_sewa.required' => 'Harga sewa harus diisi',
            'harga_sewa.numeric' => 'Harga sewa harus berupa angka',
            'jumlah.required' => 'Jumlah mobil harus diisi',
            'jumlah.numeric' => 'Jumlah mobil harus berupa angka',
            'status.required' => 'Status mobil harus diisi',
            'status.in' => 'Status mobil harus diisi dengan tersedia atau tidak tersedia',
        ]);

        $mobil = Mobil::find($id);
        $mobil->nama = $data['nama'];
        $mobil->harga_sewa = $data['harga_sewa'];
        $mobil->jumlah = $data['jumlah'];
        $mobil->status = $data['status'];
        $mobil->plat_nomor = $data['plat_nomor'];
        $mobil->save();

        return redirect()->route('mobil.index.view')->with('success', 'Mobil berhasil diubah');
    }

    public function delete($id)
    {
        try {
            $mobil = Mobil::find($id);
            $mobil->delete();

            return redirect()->route('mobil.index.view')->with('success', 'Mobil berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') { // SQLSTATE[23000] is for integrity constraint violation
                return redirect()->route('mobil.index.view')->with('error', 'Gagal menghapus mobil: mobil exist in transaksi.');
            }

            return redirect()->route('mobil.index.view')->with('error', 'Gagal menghapus mobil: ' . $e->getMessage());
        }
    }
}
