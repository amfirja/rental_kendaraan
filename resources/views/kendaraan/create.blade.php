@extends('layouts.app')

@section('title', 'Tambah Kendaraan')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Tambah Kendaraan Baru
                </div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('kendaraan.store') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Kendaraan</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Jenis</label>
                            <select name="jenis" class="form-select" required>
                                <option value="mobil">Mobil</option>
                                <option value="motor">Motor</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Plat Nomor</label>
                            <input type="text" name="plat_nomor" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Harga Sewa per Hari</label>
                            <input type="number" name="harga_sewa" class="form-control" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if($errors->any())
<div class="alert alert-danger mx-3 mt-3">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger mx-3 mt-3">
    {{ session('error') }}
</div>
@endif
@endsection