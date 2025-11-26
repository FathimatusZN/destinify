@extends('layouts.app')

@section('title', 'Dashboard Destinify')
@section('page-title', 'Dashboard Destinify')

@section('content')
    <div class="container-fluid">
        <h4 class="mb-4">Selamat Datang di Website Destinify!</h4>

        <div class="row g-4">
            {{-- Alternatif --}}
            <div class="col-md-3 col-sm-6">
                <div class="card shadow-sm border-0 text-center p-4 hover-shadow">
                    <i class="bi bi-people-fill display-3 text-primary mb-3"></i>
                    <h6 class="mb-2">Alternatif</h6>
                    <a href="{{ route('alternatif.index') }}" class="btn btn-outline-primary btn-sm">Lihat</a>
                </div>
            </div>

            {{-- Kriteria --}}
            <div class="col-md-3 col-sm-6">
                <div class="card shadow-sm border-0 text-center p-4 hover-shadow">
                    <i class="bi bi-list-check display-3 text-success mb-3"></i>
                    <h6 class="mb-2">Kriteria</h6>
                    <a href="{{ route('kriteria.index') }}" class="btn btn-outline-success btn-sm">Lihat</a>
                </div>
            </div>

            {{-- Pembobotan --}}
            <div class="col-md-3 col-sm-6">
                <div class="card shadow-sm border-0 text-center p-4 hover-shadow">
                    <i class="bi bi-calculator-fill display-3 text-warning mb-3"></i>
                    <h6 class="mb-2">Pembobotan</h6>
                    <a href="{{ url('pembobotan') }}" class="btn btn-outline-warning btn-sm">Lihat</a>
                </div>
            </div>

            {{-- Perhitungan --}}
            <div class="col-md-3 col-sm-6">
                <div class="card shadow-sm border-0 text-center p-4 hover-shadow">
                    <i class="bi bi-bar-chart-fill display-3 text-danger mb-3"></i>
                    <h6 class="mb-2">Perhitungan</h6>
                    <a href="{{ url('perhitungan') }}" class="btn btn-outline-danger btn-sm">Lihat</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .hover-shadow:hover {
            transform: translateY(-5px);
            transition: 0.3s;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
    </style>
@endsection
