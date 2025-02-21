@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Daftar Kendaraan</h1>
        <a href="{{ route('kendaraan.create') }}" class="btn btn-primary mb-3">Tambah Kendaraan</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Plat Nomor</th>
                    <th>Harga Sewa</th>
                    <th>Status</th>
                    <th>Aksi</th> <!-- Tambah kolom untuk aksi -->
                </tr>
            </thead>
            <tbody>
                @foreach ($kendaraans as $kendaraan)
                    <tr>
                        <td>{{ $kendaraan->nama }}</td>
                        <td>{{ ucfirst($kendaraan->jenis) }}</td>
                        <td>{{ $kendaraan->plat_nomor }}</td>
                        <td>Rp {{ number_format($kendaraan->harga_sewa, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-{{ $kendaraan->status == 'tersedia' ? 'success' : 'danger' }}">
                                {{ ucfirst($kendaraan->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('kendaraan.edit', $kendaraan->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('kendaraan.destroy', $kendaraan->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @foreach ($kendaraans as $kendaraan)
            @if ($kendaraan->status == 'tersedia')
                <a href="{{ route('sewa.create', $kendaraan->id) }}" class="btn btn-primary">
                    Sewa Sekarang
                </a>
            @endif
        @endforeach
    </div>
@endsection
