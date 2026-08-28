@extends('admin.layouts.app')

@section('title', 'Akses Ditolak')
@section('header', 'Akses Ditolak')

@section('content')
    <div class="max-w-2xl mx-auto text-center py-16">
        <div class="text-7xl font-bold text-gold-500 mb-4">403</div>

        <h2 class="text-2xl font-semibold text-gray-800 mb-2">
            Akses Ditolak
        </h2>

        <p class="text-gray-500 mb-6">
            Anda tidak memiliki izin untuk mengakses halaman ini.
        </p>

        <a href="{{ route('admin.dashboard') }}"
           class="inline-flex items-center px-5 py-3 rounded-lg bg-gold-500 text-white hover:bg-gold-600">
            <i class="fas fa-home mr-2"></i>
            Kembali ke Dashboard
        </a>
    </div>
@endsection