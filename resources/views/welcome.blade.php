@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-5">Daftar Kendaraan Tersedia</h1>

        <div class="row g-4">
            @foreach ($kendaraans as $kendaraan)
                <div class="col-md-4">
                    <div class="card h-100 shadow">
                        <div class="card-body">
                            <h5 class="card-title">{{ $kendaraan->nama }}</h5>
                            <div class="mb-3">
                                <span class="badge bg-info">{{ ucfirst($kendaraan->jenis) }}</span>
                                <span class="badge bg-success">{{ ucfirst($kendaraan->status) }}</span>
                            </div>
                            <p class="card-text">
                                <i class="fas fa-tag me-2"></i>Rp
                                {{ number_format($kendaraan->harga_sewa, 0, ',', '.') }}/hari<br>
                                <i class="fas fa-car me-2"></i>{{ $kendaraan->plat_nomor }}
                            </p>
                            <a href="{{ route('sewa.create', $kendaraan) }}" class="btn btn-primary w-100">
                                <i class="fas fa-shopping-cart me-2"></i>Sewa Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach ($kendaraans as $kendaraan)
                @if ($kendaraan->status == 'tersedia')
                    <a href="{{ route('sewa.create', $kendaraan->id) }}" class="btn btn-primary">
                        Sewa Sekarang
                    </a>
                @endif
            @endforeach
        </div>
    </div>
    <div class="vehicle-card">
        <div class="card">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Toyota Avanza</h5>
                <span class="badge-status badge-available">Tersedia</span>
                <a href="#" class="btn btn-primary mt-3">Sewa Sekarang</a>
            </div>
        </div>
    </div>
@endsection
