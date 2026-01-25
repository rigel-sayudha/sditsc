@extends('layouts.app')

@section('title', 'Berita Sekolah - SDIT SEMESTA CENDEKIA')

@section('content')
<div class="min-h-screen pt-24 pb-12">
    <div class="container mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Berita Sekolah</h1>
            <p class="text-lg text-gray-600">Informasi terbaru seputar kegiatan dan prestasi sekolah</p>
        </div>

        <!-- Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($articles as $article)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="relative">
                    @if($article->gambar)
                        <img src="{{ asset('storage/' . $article->gambar) }}" 
                             alt="{{ $article->judul }}" 
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">No Image</span>
                        </div>
                    @endif
                    <div class="absolute bottom-2 left-2 bg-black bg-opacity-50 rounded-md px-3 py-1">
                        <span class="text-white text-xs font-semibold">
                            {{ $article->created_at->format('d M Y') }}
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2">
                        {{ $article->judul }}
                    </h2>
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        {{ strip_tags($article->konten) }}
                    </p>
                    <a href="{{ route('berita.show', $article->slug) }}" 
                       class="inline-block px-6 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Baca Selengkapnya
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $articles->links() }}
        </div>
    </div>
</div>
@endsection
