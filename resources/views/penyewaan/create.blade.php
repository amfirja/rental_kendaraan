@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Sewa {{ $kendaraan->nama }}</h3>
            <p class="mb-0">Plat: {{ $kendaraan->plat_nomor }}</p>
        </div>
        
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p class="mb-0">• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('sewa.store') }}">
                @csrf
                <input type="hidden" name="kendaraan_id" value="{{ $kendaraan->id }}">
                
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" 
                               name="tanggal_mulai" 
                               class="form-control"
                               min="{{ $min_date }}"
                               max="{{ $max_date }}"
                               required>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" 
                               name="tanggal_selesai" 
                               class="form-control"
                               min="{{ $min_date }}"
                               max="{{ $max_date }}"
                               required>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Nama Penyewa</label>
                        <input type="text" 
                               name="nama_penyewa" 
                               class="form-control"
                               placeholder="Nama lengkap"
                               required>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Nomor HP</label>
                        <input type="tel" 
                               name="kontak" 
                               class="form-control"
                               placeholder="0812-3456-7890"
                               pattern="[0-9]{10,13}"
                               required>
                        <small class="form-text text-muted">Contoh: 081234567890</small>
                    </div>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-check-circle me-2"></i>Proses Sewa
                    </button>
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection