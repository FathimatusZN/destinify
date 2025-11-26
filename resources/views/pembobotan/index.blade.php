@extends('layouts.app')

@section('title', 'Pembobotan Kriteria')
@section('page-title', 'Input Nilai Perbandingan (AHP)')

@section('content')
<div class="container-fluid">

    {{-- Pesan sukses atau error --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Form input nilai perbandingan --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body d-flex gap-2 align-items-center">
            <form action="{{ route('pembobotan.update') }}" method="POST" class="d-flex flex-wrap gap-2 align-items-center w-100">
                @csrf

 <select name="kriteria1" required>
    <option value="">-- Pilih Kriteria 1 --</option>
    @foreach($kriterias as $k)
        <option value="{{ $k->kode_kriteria }}">{{ $k->kode_kriteria }} - {{ $k->nama_kriteria }}</option>
    @endforeach
</select>

                <select name="nilai" class="form-select w-auto" required>
                    <option value="">-- Pilih Nilai --</option>
                    <option value="1">1 - Sama penting dengan</option>
                    <option value="2">2 - Mendekati sedikit lebih penting dari</option>
                    <option value="3">3 - Sedikit lebih penting dari</option>
                    <option value="4">4 - Mendekati lebih penting dari</option>
                    <option value="5">5 - Lebih penting dari</option>
                    <option value="6">6 - Mendekati sangat penting dari</option>
                    <option value="7">7 - Sangat penting dari</option>
                    <option value="8">8 - Mendekati mutlak dari</option>
                    <option value="9">9 - Mutlak sangat penting dari</option>
                </select>

    
<select name="kriteria2" required>
    <option value="">-- Pilih Kriteria 2 --</option>
    @foreach($kriterias as $k)
        <option value="{{ $k->kode_kriteria }}">{{ $k->kode_kriteria }} - {{ $k->nama_kriteria }}</option>
    @endforeach
</select>

                <button type="submit" class="btn btn-dark">
                    <i class="bi bi-pencil-square"></i> Ubah
                </button>
            </form>
        </div>
    </div>

    {{-- Matriks perbandingan --}}
<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="mb-3">Matriks Perbandingan Kriteria</h5>
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Kode</th>
                    @foreach ($kriterias as $k)
                        <th>{{ $k->kode_kriteria }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($kriterias as $k1)
                    <tr>
                        <th class="table-dark">{{ $k1->kode_kriteria }}</th>
                        @foreach ($kriterias as $k2)
                            @php
                                $value = $matriks[$k1->kode_kriteria][$k2->kode_kriteria] ?? '-';
                                $color = ($k1->kode_kriteria == $k2->kode_kriteria) ? 'table-success'
                                        : (($loop->parent->index < $loop->index) ? 'table-danger' : 'table-success-subtle');
                            @endphp
                            <td class="{{ $color }}">{{ is_numeric($value) ? number_format($value, 2) : $value }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- ✅ Tambahan tombol hitung --}}
        <div class="text-end mt-3">
            <form action="{{ route('pembobotan.hitung') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-calculator"></i> Hitung Pembobotan
                </button>
            </form>
        </div>
        {{-- ✅ Akhir tambahan --}}
    </div>
</div>

@endsection
