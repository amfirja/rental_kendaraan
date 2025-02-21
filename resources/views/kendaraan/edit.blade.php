@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Edit Kendaraan</div>
        <div class="card-body">
            <form action="{{ route('kendaraan.update', $kendaraan) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label>Nama Kendaraan</label>
                    <input type="text" name="nama" class="form-control" value="{{ $kendaraan->nama }}" required>
                </div>
                
                <div class="mb-3">
                    <label>Jenis</label>
                    <select name="jenis" class="form-select" required>
                        <option value="{{ \App\Models\Kendaraan::JENIS_MOBIL }}" {{ $kendaraan->jenis == \App\Models\Kendaraan::JENIS_MOBIL ? 'selected' : '' }}>Mobil</option>
                        <option value="{{ \App\Models\Kendaraan::JENIS_MOTOR }}" {{ $kendaraan->jenis == \App\Models\Kendaraan::JENIS_MOTOR ? 'selected' : '' }}>Motor</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label>Plat Nomor</label>
                    <input type="text" name="plat_nomor" class="form-control" value="{{ $kendaraan->plat_nomor }}" required>
                </div>
                
                <div class="mb-3">
                    <label>Harga Sewa</label>
                    <input type="number" name="harga_sewa" class="form-control" value="{{ $kendaraan->harga_sewa }}" required>
                </div>
                
                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select" required>
                        <option value="{{ \App\Models\Kendaraan::STATUS_TERSEDIA }}" {{ $kendaraan->status == \App\Models\Kendaraan::STATUS_TERSEDIA ? 'selected' : '' }}>Tersedia</option>
                        <option value="{{ \App\Models\Kendaraan::STATUS_DISEWA }}" {{ $kendaraan->status == \App\Models\Kendaraan::STATUS_DISEWA ? 'selected' : '' }}>Disewa</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection