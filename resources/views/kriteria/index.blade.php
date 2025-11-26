@extends('layouts.app')

@section('title', 'Data Kriteria')
@section('page-title', 'Manajemen Data Kriteria')

@section('content')
<div class="container-fluid">

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Daftar Kriteria</h5>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahModal">
            <i class="bi bi-plus-lg"></i> Tambah Kriteria
        </button>
    </div>

    {{-- Tabel --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th>Kode</th>
                        <th>Nama Kriteria</th>
                        <th>Atribut</th>
                        <th>Tahun</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kriterias as $index => $k)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $k->kode_kriteria }}</td>
                            <td>{{ $k->nama_kriteria }}</td>
                            <td class="text-center">
                                <span class="badge bg-{{ $k->atribut == 'Benefit' ? 'success' : 'danger' }}">
                                    {{ $k->atribut }}
                                </span>
                            </td>
                            <td class="text-center">{{ $k->tahun }}</td>
                            <td class="text-center">
                                {{-- Tombol Edit --}}
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $k->kode_kriteria }}">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('kriteria.destroy', $k->kode_kriteria) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>

                        {{-- Modal Edit --}}
                        <div class="modal fade" id="editModal{{ $k->kode_kriteria }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('kriteria.update', $k->kode_kriteria) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header bg-warning">
                                            <h5 class="modal-title">Edit Kriteria</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Kode Kriteria</label>
                                                <input type="text" name="kode_kriteria" class="form-control" value="{{ $k->kode_kriteria }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nama Kriteria</label>
                                                <input type="text" name="nama_kriteria" class="form-control" value="{{ $k->nama_kriteria }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Atribut</label>
                                                <select name="atribut" class="form-select" required>
                                                    <option value="Benefit" {{ $k->atribut == 'Benefit' ? 'selected' : '' }}>Benefit</option>
                                                    <option value="Cost" {{ $k->atribut == 'Cost' ? 'selected' : '' }}>Cost</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Tahun</label>
                                                <input type="text" name="tahun" class="form-control" value="{{ $k->tahun }}" required>
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
                            <td colspan="6" class="text-center">Belum ada data kriteria.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('kriteria.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Kriteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Kode Kriteria</label>
                        <input type="text" name="kode_kriteria" class="form-control" placeholder="Contoh: C1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Kriteria</label>
                        <input type="text" name="nama_kriteria" class="form-control" placeholder="Contoh: Harga" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Atribut</label>
                        <select name="atribut" class="form-select" required>
                            <option value="">-- Pilih Atribut --</option>
                            <option value="Benefit">Benefit</option>
                            <option value="Cost">Cost</option>
                        </select>
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
