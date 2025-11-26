@extends('layouts.app')

@section('title', 'Input Penilaian Alternatif')
@section('page-title', 'Penilaian Alternatif terhadap Kriteria')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Form Penilaian Alternatif</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('penilaian.store') }}" method="POST">
        @csrf
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Alternatif</th>
                        @foreach($kriterias as $krit)
                            <th>{{ $krit->nama_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($alternatifs as $alt)
                        <tr>
                            <td class="fw-bold">{{ $alt->nama_alternatif }}</td>
                            @foreach($kriterias as $krit)
                                @php
                                    $nilaiLama = $penilaian
                                        ->where('alternatif_id', $alt->id)
                                        ->where('kriteria_id', $krit->id)
                                        ->first()->nilai ?? '';
                                @endphp
                                <td>
                                    <input type="number" step="1" min="1" max="10"
                                           class="form-control text-center"
                                           name="alternatif[{{ $alt->id }}][{{ $krit->id }}]"
                                           value="{{ $nilaiLama }}">
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-end mt-3">
            <button type="submit" class="btn btn-primary">
                Simpan Penilaian
            </button>
        </div>
    </form>
</div>
@endsection
