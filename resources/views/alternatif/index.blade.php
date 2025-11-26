@extends('layouts.app')

@section('title', 'Data Alternatif')
@section('page-title', 'Manajemen Data Alternatif')

@section('content')
<div class="container-fluid">

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Header & tombol tambah --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Daftar Alternatif</h5>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahModal">
            <i class="bi bi-plus-lg"></i> Tambah Alternatif
        </button>
    </div>

    {{-- Tabel Alternatif --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th width="5%">No</th>
                        <th>Kode Alternatif</th>
                        <th>Nama Alternatif</th>
                        <th>Deskripsi</th>
                        <th>Tahun</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($alternatifs as $index => $alt)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $alt->kode_alternatif }}</td>
                            <td>{{ $alt->nama_alternatif }}</td>
                            <td>{{ $alt->deskripsi ?? '-' }}</td>
                            <td class="text-center">{{ $alt->tahun }}</td>
                            <td class="text-center">
                                {{-- Tombol Edit --}}
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $alt->kode_alternatif }}">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('alternatif.destroy', $alt->kode_alternatif) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>

                        {{-- Modal Edit --}}
                        <div class="modal fade" id="editModal{{ $alt->kode_alternatif }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('alternatif.update', $alt->kode_alternatif) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header bg-warning text-dark">
                                            <h5 class="modal-title">Edit Alternatif</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Kode Alternatif</label>
                                                <input type="text" name="kode_alternatif" class="form-control" value="{{ $alt->kode_alternatif }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nama Alternatif</label>
                                                <input type="text" name="nama_alternatif" class="form-control" value="{{ $alt->nama_alternatif }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control" rows="2">{{ $alt->deskripsi }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Tahun</label>
                                                <input type="text" name="tahun" class="form-control" value="{{ $alt->tahun }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data alternatif.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Tambah Alternatif --}}
<div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('alternatif.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Alternatif</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Kode Alternatif</label>
                        <input type="text" name="kode_alternatif" class="form-control" placeholder="Contoh: A1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Alternatif</label>
                        <input type="text" name="nama_alternatif" class="form-control" placeholder="Contoh: Bimbel GO" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="2" placeholder="Keterangan singkat tentang bimbel..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="text" name="tahun" class="form-control" placeholder="Contoh: 2025" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
