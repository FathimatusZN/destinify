{{-- resources/views/perhitungan/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Perhitungan AHP')
@section('page-title', 'Hasil Perhitungan AHP')

@section('content')
    <div class="container-fluid">

        {{-- Pesan sukses / error / warning --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning alert-dismissible fade show">
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Matriks Perbandingan Kriteria --}}
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Matriks Perbandingan Kriteria</h5>
            </div>
            <div class="card-body">
                @if (empty($matriks))
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> Belum ada data matriks. Silakan lakukan pembobotan kriteria
                        terlebih dahulu.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Kriteria</th>
                                    @foreach ($kriterias as $k)
                                        <th>{{ $k->kode_kriteria }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kriterias as $k1)
                                    <tr>
                                        <td><strong>{{ $k1->kode_kriteria }}</strong></td>
                                        @foreach ($kriterias as $k2)
                                            @php
                                                $val = $matriks[$k1->kode_kriteria][$k2->kode_kriteria] ?? 0;
                                            @endphp
                                            <td>{{ number_format($val, 5) }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach

                                {{-- Baris Total Kolom --}}
                                <tr class="fw-bold" style="background-color: #f5f5f5;">
                                    <td>Total Kolom</td>
                                    @foreach ($kriterias as $k)
                                        <td>{{ number_format($totalKolom[$k->kode_kriteria] ?? 0, 5) }}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- Matriks Bobot Prioritas --}}
        <div class="card mb-3">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Matriks Bobot Prioritas Kriteria</h5>
            </div>
            <div class="card-body">
                @if (empty($bobot))
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> Belum ada data bobot. Silakan hitung pembobotan AHP terlebih
                        dahulu.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Kriteria</th>
                                    <th>Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bobot as $k => $b)
                                    <tr>
                                        <td>{{ $k }}</td>
                                        <td>{{ number_format($b, 5) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- Matriks Konsistensi --}}
        <div class="card mb-3">
            <div
                class="card-header {{ $ahpKonsisten ? 'bg-success' : 'bg-warning' }} text-{{ $ahpKonsisten ? 'white' : 'dark' }}">
                <h5 class="mb-0">Hasil Konsistensi AHP</h5>
            </div>
            <div class="card-body">
                @if (!$lamdaMax)
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> Belum ada hasil perhitungan. Silakan hitung pembobotan AHP
                        terlebih dahulu.
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-2"><strong>λ max (Lambda Max):</strong> {{ number_format($lamdaMax, 5) }}</p>
                            <p class="mb-2"><strong>CI (Consistency Index):</strong> {{ number_format($ci, 5) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><strong>RI (Random Index):</strong> {{ number_format($ri, 5) }}</p>
                            <p class="mb-2"><strong>CR (Consistency Ratio):</strong> {{ number_format($cr, 5) }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center p-3 rounded"
                        style="background-color: {{ $ahpKonsisten ? '#d4edda' : '#fff3cd' }};">
                        @if ($ahpKonsisten)
                            <h5 class="text-success mb-2">
                                <i class="bi bi-check-circle-fill"></i> Pembobotan Konsisten
                            </h5>
                            <p class="mb-0">CR = {{ number_format($cr, 5) }} < 0.1. Anda dapat melanjutkan ke pencarian
                                    rekomendasi.</p>
                                @else
                                    <h5 class="text-warning mb-2">
                                        <i class="bi bi-exclamation-triangle-fill"></i> Pembobotan Tidak Konsisten
                                    </h5>
                                    <p class="mb-0">CR = {{ number_format($cr, 5) }} ≥ 0.1. Silakan ubah nilai
                                        perbandingan kriteria pada halaman pembobotan.</p>
                        @endif
                    </div>

                    @if ($ahpKonsisten)
                        <div class="text-end mt-3">
                            <a href="{{ route('rekomendasi.index') }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-search"></i> Lanjut ke Pencarian Rekomendasi
                            </a>
                        </div>
                    @else
                        <div class="text-end mt-3">
                            <a href="{{ route('pembobotan.index') }}" class="btn btn-warning">
                                <i class="bi bi-arrow-left"></i> Kembali ke Pembobotan
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </div>

    </div>
@endsection
