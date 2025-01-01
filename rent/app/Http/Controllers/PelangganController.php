<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $pelanggans = Pelanggan::where('nama', 'like', '%' . $search . '%')
                ->orWhere('alamat', 'like', '%' . $search . '%')
                ->orWhere('no_hp', 'like', '%' . $search . '%')
                ->get()->sortByDesc('created_at');
        } else {
            $pelanggans = Pelanggan::all()->sortByDesc('created_at');
        }

        return view('pelanggan.index', compact('pelanggans', 'search'));
    }

    public function createView()
    {
        return view('pelanggan.create');
    }

    public function editView($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function create(Request $request)
    {
        $data = $request->validate(
            [
                'nama' => 'required|string|min:3',
                'alamat' => 'required|string|min:3',
                'no_hp' => 'required|string|min:10|max:15',
            ],
            [
                'nama.required' => 'Nama harus diisi',
                'nama.min' => 'Nama minimal 3 karakter',
                'alamat.required' => 'Alamat harus diisi',
                'alamat.min' => 'Alamat minimal 3 karakter',
                'no_hp.required' => 'No HP harus diisi',
                'no_hp.min' => 'No HP minimal 10 karakter',
                'no_hp.max' => 'No HP maksimal 15 karakter',
            ]
        );

        $pelanggan = new Pelanggan();
        $pelanggan->nama = $data['nama'];
        $pelanggan->alamat = $data['alamat'];
        $pelanggan->no_hp = $data['no_hp'];
        $pelanggan->save();

        return redirect()->route('pelanggan.index.view')->with('success', 'Pelanggan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'nama' => 'required|string|min:3',
                'alamat' => 'required|string|min:3',
                'no_hp' => 'required|string|min:10|max:15',
            ],
            [
                'nama.required' => 'Nama harus diisi',
                'nama.min' => 'Nama minimal 3 karakter',
                'alamat.required' => 'Alamat harus diisi',
                'alamat.min' => 'Alamat minimal 3 karakter',
                'no_hp.required' => 'No HP harus diisi',
                'no_hp.min' => 'No HP minimal 10 karakter',
                'no_hp.max' => 'No HP maksimal 15 karakter',
            ]
        );

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->nama = $data['nama'];
        $pelanggan->alamat = $data['alamat'];
        $pelanggan->no_hp = $data['no_hp'];
        $pelanggan->save();

        return redirect()->route('pelanggan.index.view')->with('success', 'Pelanggan berhasil diubah');
    }

    public function delete($id)
    {
        try {
            $pelanggan = Pelanggan::findOrFail($id);
            $pelanggan->delete();

            return redirect()->route('pelanggan.index.view')->with('success', 'Pelanggan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') { // SQLSTATE[23000] is for integrity constraint violation
                return redirect()->route('pelanggan.index.view')->with('error', 'Gagal menghapus pelanggan: Pelanggan exist in transaksi.');
            }

            return redirect()->route('pelanggan.index.view')->with('error', 'Gagal menghapus pelanggan: ' . $e->getMessage());
        }
    }
}
