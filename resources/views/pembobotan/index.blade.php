{{-- resources/views/pembobotan/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Pembobotan Kriteria')
@section('page-title', 'Input Nilai Perbandingan (AHP)')

@section('content')
    <div class="container-fluid">
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

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('pembobotan.update') }}" method="POST" class="row g-3 align-items-end">
                    @csrf

                    <div class="col-md-3">
                        <label class="form-label">Kriteria 1</label>
                        <select name="kriteria1" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            @foreach ($kriterias as $k)
                                <option value="{{ $k->kode_kriteria }}">{{ $k->kode_kriteria }} - {{ $k->nama_kriteria }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Nilai Perbandingan</label>
                        <select name="nilai" class="form-select" required>
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
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Kriteria 2</label>
                        <select name="kriteria2" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            @foreach ($kriterias as $k)
                                <option value="{{ $k->kode_kriteria }}">{{ $k->kode_kriteria }} - {{ $k->nama_kriteria }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-1 w-100">
                            <i class="bi bi-pencil-square"></i> Ubah
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">Matriks Perbandingan Kriteria</h5>
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">
                        <thead class="table-header-secondary text-center">
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
                                    <th class="cell-d-secondary">{{ $k1->kode_kriteria }}</th>
                                    @foreach ($kriterias as $k2)
                                        @php
                                            $value = $matriks[$k1->kode_kriteria][$k2->kode_kriteria] ?? '-';
                                            $color =
                                                $k1->kode_kriteria == $k2->kode_kriteria
                                                    ? 'cell-d-1'
                                                    : ($loop->parent->index < $loop->index
                                                        ? 'cell-d-3'
                                                        : 'table-success-subtle');
                                        @endphp
                                        <td class="{{ $color }}">
                                            {{ is_numeric($value) ? number_format($value, 2) : $value }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-end mt-3">
                    <form action="{{ route('pembobotan.hitung') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-calculator"></i> Hitung Pembobotan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
