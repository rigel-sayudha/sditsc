@extends('layouts.app')

@section('title', 'Pendaftaran Siswa Baru - SDIT SEMESTA CENDEKIA')

@section('content')
@push('styles')
<style>
    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

<div class="min-h-screen pt-24 pb-12">
    <div class="container mx-auto px-4">
        
        <!-- Error Messages -->
        @if ($errors->any())
            <div class="max-w-5xl mx-auto mb-6">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="max-w-5xl mx-auto mb-6">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            </div>
        @endif
        
        @php
            $step = request()->get('step', 1);
        @endphp

        <div class="max-w-5xl mx-auto mb-8">
            <div class="flex justify-center items-center space-x-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 flex items-center justify-center rounded-full font-bold" style="background-color:{{ $step >= 1 ? '#0f8941' : '#e5e7eb' }};color:{{ $step >= 1 ? '#fff' : '#1f2937' }};">1</div>
                    <div class="ml-2 text-sm font-medium {{ $step >= 1 ? 'text-green-600' : 'text-gray-500' }}">Data Diri</div>
                </div>
                <div class="w-16 h-1" style="background-color:{{ $step >= 2 ? '#0f8941' : '#e5e7eb' }};"></div>
                <div class="flex items-center">
                    <div class="w-10 h-10 flex items-center justify-center rounded-full font-bold" style="background-color:{{ $step >= 2 ? '#0f8941' : '#e5e7eb' }};color:{{ $step >= 2 ? '#fff' : '#1f2937' }};">2</div>
                    <div class="ml-2 text-sm font-medium {{ $step >= 2 ? 'text-green-600' : 'text-gray-500' }}">Jadwal Tes</div>
                </div>
                {{-- <div class="w-16 h-1" style="background-color:{{ $step >= 3 ? '#0f8941' : '#e5e7eb' }};"></div>
                <div class="flex items-center">
                    <div class="w-10 h-10 flex items-center justify-center rounded-full font-bold" style="background-color:{{ $step >= 3 ? '#0f8941' : '#e5e7eb' }};color:{{ $step >= 3 ? '#fff' : '#1f2937' }};">3</div>
                    <div class="ml-2 text-sm font-medium {{ $step >= 3 ? 'text-green-600' : 'text-gray-500' }}">Sumbangan</div>
                </div> --}}
            </div>
        </div>

        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-10 fade-in">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Pendaftaran Siswa Baru</h1>
                <p class="text-lg text-gray-600">Tahun Ajaran 2026/2027</p>
            </div>

            @if($step == 1)
                @include('pendaftaran.step1')
            @elseif($step == 2)
                @include('pendaftaran.step2')
            @endif
        </div>
    </div>
</div>
@endsection
