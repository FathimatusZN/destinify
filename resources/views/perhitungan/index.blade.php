@extends('layouts.app')

@section('title', 'Perhitungan AHP & TOPSIS')
@section('page-title', 'Hasil Perhitungan')

@section('content')
<div class="container-fluid">

    {{-- Pesan sukses / error --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

 {{-- Matriks Perbandingan Kriteria --}}
<div class="card mb-3">
    <div class="card-header bg-primary text-white">Matriks Perbandingan Kriteria</div>
    <div class="card-body">
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
                                // Ambil nilai dari matriks (kalau ada), kalau tidak ada isi 0
                                $val = $matriks[$k1->kode_kriteria][$k2->kode_kriteria] ?? 0;
                            @endphp
                            <td>{{ number_format($val, 2) }}</td>
                        @endforeach
                    </tr>
                @endforeach

                {{-- Baris Total Kolom --}}
                <tr class="fw-bold" style="background-color: #f5f5f5;">
                    <td>Total Kolom</td>
                    @foreach ($kriterias as $k)
                        <td>{{ number_format($totalKolom[$k->kode_kriteria] ?? 0, 2) }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>



    {{-- 2. Matriks Bobot Prioritas --}}
    <div class="card mb-3">
        <div class="card-header bg-success text-white">Matriks Bobot Prioritas Kriteria</div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Kriteria</th>
                        <th>Bobot</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bobot as $k => $b)
                        <tr>
                            <td>{{ $k }}</td>
                            <td>{{ number_format($b, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

{{-- Matriks Konsistensi --}}
<div class="card mb-3">
    <div class="card-header bg-warning text-dark">Matriks Konsistensi</div>
    <div class="card-body">
        <p><strong>λ max (Lamda Max):</strong> {{ number_format($lamdaMax, 2) }}</p>
        <p><strong>CI (Consistency Index):</strong> {{ number_format($ci, 2) }}</p>
        <p><strong>RI (Random Index):</strong> {{ number_format($ri, 2) }}</p>
        <p><strong>CR (Consistency Ratio):</strong> {{ number_format($cr, 2) }}</p>
        @if($cr < 0.1)
            <p class="text-success">Konsisten ✅</p>
        @else
            <p class="text-danger">Tidak Konsisten ❌</p>
        @endif
    </div>
</div>


    {{-- 4. Perhitungan TOPSIS --}}
    <div class="card mb-3">
        <div class="card-header bg-info text-white">Perhitungan TOPSIS</div>
        <div class="card-body">

            {{-- 4.1 Matriks Normalisasi --}}
            <h6>Matriks Normalisasi</h6>
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        @foreach($kriterias as $k)
                            <th>{{ $k->kode_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($normalisasi as $alt => $vals)
                        <tr>
                            <td>{{ $alt }}</td>
                            @foreach($kriterias as $k)
                                <td>{{ number_format($vals[$k->kode_kriteria] ?? 0, 4) }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- 4.2 Matriks Terbobot --}}
            <h6>Matriks Terbobot</h6>
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        @foreach($kriterias as $k)
                            <th>{{ $k->kode_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($terbobot as $alt => $vals)
                        <tr>
                            <td>{{ $alt }}</td>
                            @foreach($kriterias as $k)
                                <td>{{ number_format($vals[$k->kode_kriteria] ?? 0, 4) }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- 4.3 Solusi Ideal --}}
            <h6>Solusi Ideal Positif & Negatif</h6>
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Kriteria</th>
                        <th>Ideal +</th>
                        <th>Ideal -</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kriterias as $k)
                        <tr>
                            <td>{{ $k->kode_kriteria }}</td>
                            <td>{{ number_format($idealPos[$k->kode_kriteria] ?? 0, 4) }}</td>
                            <td>{{ number_format($idealNeg[$k->kode_kriteria] ?? 0, 4) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- 4.4 Jarak ke Solusi Ideal & Skor --}}
            <h6>Jarak & Skor</h6>
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        <th>D+</th>
                        <th>D-</th>
                        <th>Skor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($preferensi as $alt => $val)
                        <tr>
                            <td>{{ $alt }}</td>
                            <td>{{ number_format($distPos[$alt] ?? 0, 4) }}</td>
                            <td>{{ number_format($distNeg[$alt] ?? 0, 4) }}</td>
                            <td>{{ number_format($val, 4) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

                        {{-- 4.5 Ranking --}}
            <h6>Ranking Alternatif</h6>
            <table class="table table-bordered table-sm text-center align-middle">
                <thead class="table-light">
                    <tr>
                          <th style="width: 8%;">Rank</th>
                          <th style="width: 15%;">Kode</th>
                         <th style="width: 50%;">Nama Alternatif</th>
                         <th style="width: 15%;">Skor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hasilRanking as $rank)
                        <tr>
                            <td>{{ $rank['ranking'] }}</td>
                            <td>{{ $rank['kode_alternatif'] }}</td>
                            <td>{{ $rank['nama_alternatif'] }}</td>
                            <td>{{ number_format($rank['nilai_preferensi'], 4) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
