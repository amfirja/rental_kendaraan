@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Kendaraan</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $kendaraan->nama }}</h5>
            <p class="card-text">
                Jenis: {{ $kendaraan->jenis }}<br>
                Plat: {{ $kendaraan->plat_nomor }}<br>
                Harga Sewa: Rp {{ number_format($kendaraan->harga_sewa, 0, ',', '.') }}<br>
                Status: {{ $kendaraan->status }}
            </p>
            <a href="{{ route('kendaraan.index') }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>
@endsection