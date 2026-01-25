<title>Succesful- SDIT SEMESTA CENDEKIA</title>
@extends('layouts.app')

@section('content')
<div class="min-h-screen pt-24 pb-12">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden fade-in">
            <div class="p-8 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 mb-6 rounded-full bg-green-100">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-4">Pendaftaran Berhasil!</h1>
                <p class="text-lg text-gray-600 mb-8">
                    Terima kasih telah mendaftar di SDIT SEMESTA CENDEKIA.<br>
                    Silahkan datang ke sekolah sesuai dengan jadwal yang dipilih.
                </p>

                <div class="mt-8">
                    <a href="{{ url('/') }}" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
