<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class KendaraanController extends Controller
{
    /**
     * Menampilkan daftar kendaraan.
     */
    public function index()
    {
        $kendaraans = Kendaraan::latest()->get();
        return view('kendaraan.index', compact('kendaraans'));
    }

    /**
     * Menampilkan form untuk menambah kendaraan.
     */
    public function create()
    {
        return view('kendaraan.create');
    }

    /**
     * Menyimpan kendaraan baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => ['required', Rule::in([Kendaraan::JENIS_MOBIL, Kendaraan::JENIS_MOTOR])],
            'plat_nomor' => 'required|string|unique:kendaraans,plat_nomor',
            'harga_sewa' => 'required|numeric|min:0'
        ]);

        try {
            // Set default status
            $validatedData['status'] = Kendaraan::STATUS_TERSEDIA;
            
            Kendaraan::create($validatedData);
            
            return redirect()->route('kendaraan.index')
                ->with('success', 'Kendaraan berhasil ditambahkan');
                
        } catch (\Exception $e) {
            Log::error('Error creating kendaraan: '.$e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan kendaraan. Silakan coba lagi.');
        }
    }

    /**
     * Menampilkan detail kendaraan.
     */
    public function show(Kendaraan $kendaraan)
    {
        return view('kendaraan.show', compact('kendaraan'));
    }

    /**
     * Menampilkan form edit kendaraan.
     */
    public function edit(Kendaraan $kendaraan)
    {
        return view('kendaraan.edit', compact('kendaraan'));
    }

    /**
     * Update kendaraan di database.
     */
    public function update(Request $request, Kendaraan $kendaraan)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => ['required', Rule::in([Kendaraan::JENIS_MOBIL, Kendaraan::JENIS_MOTOR])],
            'plat_nomor' => 'required|string|unique:kendaraans,plat_nomor,'.$kendaraan->id,
            'harga_sewa' => 'required|numeric|min:0',
            'status' => ['required', Rule::in([Kendaraan::STATUS_TERSEDIA, Kendaraan::STATUS_DISEWA])]
        ]);

        try {
            $kendaraan->update($validatedData);
            
            return redirect()->route('kendaraan.index')
                ->with('success', 'Data kendaraan berhasil diupdate');
                
        } catch (\Exception $e) {
            Log::error('Error updating kendaraan: '.$e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengupdate kendaraan. Silakan coba lagi.');
        }
    }

    /**
     * Hapus kendaraan dari database.
     */
    public function destroy(Kendaraan $kendaraan)
    {
        try {
            $kendaraan->delete();
            
            return redirect()->route('kendaraan.index')
                ->with('success', 'Kendaraan berhasil dihapus');
                
        } catch (\Exception $e) {
            Log::error('Error deleting kendaraan: '.$e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal menghapus kendaraan. Silakan coba lagi.');
        }
    }
}