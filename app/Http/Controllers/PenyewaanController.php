<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Penyewaan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PenyewaanController extends Controller
{
    public function create(Kendaraan $kendaraan)
    {
        return view('penyewaan.create', [
            'kendaraan' => $kendaraan,
            'min_date' => now()->format('Y-m-d'),
            'max_date' => now()->addMonths(3)->format('Y-m-d'),
            'harga_sewa' => number_format($kendaraan->harga_sewa, 0, ',', '.')
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'tanggal_mulai' => [
                'required',
                'date',
                'after_or_equal:today',
                function ($attribute, $value, $fail) {
                    if (Carbon::parse($value)->isSunday()) {
                        $fail('Tidak bisa menyewa pada hari Minggu');
                    }
                }
            ],
            'tanggal_selesai' => [
                'required',
                'date',
                'after:tanggal_mulai',
                function ($attribute, $value, $fail) use ($request) {
                    $diff = Carbon::parse($request->tanggal_mulai)->diffInDays($value);
                    if ($diff > 30) {
                        $fail('Maksimal penyewaan 30 hari');
                    }
                }
            ],
            'nama_penyewa' => 'required|max:255|regex:/^[a-zA-Z\s]+$/',
            'kontak' => 'required|max:20|regex:/^08[0-9]{8,11}$/'
        ], [
            'nama_penyewa.regex' => 'Nama hanya boleh mengandung huruf dan spasi',
            'kontak.regex' => 'Format nomor HP tidak valid (contoh: 081234567890)'
        ]);

        try {
            DB::beginTransaction();

            $kendaraan = Kendaraan::findOrFail($validated['kendaraan_id']);

            if ($kendaraan->status !== Kendaraan::STATUS_TERSEDIA) {
                throw new \Exception('Kendaraan sedang tidak tersedia');
            }

            $jumlah_hari = Carbon::parse($validated['tanggal_mulai'])
                ->diffInDays($validated['tanggal_selesai']);

            $total_biaya = $this->calculateTotalBiaya(
                $kendaraan->harga_sewa,
                $jumlah_hari,
                $validated['tanggal_mulai']
            );

            $penyewaan = $kendaraan->penyewaans()->create([
                'tanggal_mulai' => $validated['tanggal_mulai'],
                'tanggal_selesai' => $validated['tanggal_selesai'],
                'total_biaya' => $total_biaya,
                'nama_penyewa' => $validated['nama_penyewa'],
                'kontak' => $validated['kontak']
            ]);

            $kendaraan->update(['status' => Kendaraan::STATUS_DISEWA]);

            DB::commit();

            return redirect()->route('home')->with([
                'success' => 'Penyewaan berhasil!',
                'details' => [
                    'Periode' => Carbon::parse($penyewaan->tanggal_mulai)->translatedFormat('d M Y') . 
                                ' - ' . 
                                Carbon::parse($penyewaan->tanggal_selesai)->translatedFormat('d M Y'),
                    'Durasi' => $jumlah_hari . ' Hari',
                    'Total Biaya' => 'Rp ' . number_format($total_biaya, 0, ',', '.')
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Penyewaan Error: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal melakukan penyewaan: ' . $e->getMessage());
        }
    }

    private function calculateTotalBiaya($harga_sewa, $jumlah_hari, $tanggal_mulai)
    {
        $startDate = Carbon::parse($tanggal_mulai);
        $total = 0;
        
        for ($i = 0; $i < $jumlah_hari; $i++) {
            $currentDate = $startDate->copy()->addDays($i);
            
            // Harga lebih mahal di akhir pekan
            if ($currentDate->isWeekend()) {
                $total += $harga_sewa * 1.2;
            } else {
                $total += $harga_sewa;
            }
        }
        
        return $total;
    }
}