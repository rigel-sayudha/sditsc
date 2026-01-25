@extends('layouts.appberita')

@section('title'){{ $article->judul }} - SDIT SEMESTA CENDEKIA @endsection

@section('content')
<div class="min-h-screen pt-24 pb-12">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Article Header -->
            <div class="mb-8">
                @if($article->gambar)
                     <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-50 h-50 object-cover rounded">
                @endif
                <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $article->judul }}</h1>
                <div class="flex items-center text-gray-600 mb-6">
                    <span class="mr-4">
                        <i class="far fa-calendar-alt mr-2"></i>
                        {{ $article->created_at->format('d M Y') }}
                    </span>
                    <span>
                        <i class="far fa-user mr-2"></i>
                        {{ $article->user->name ?? 'Admin' }}
                    </span>
                </div>
            </div>

            <div class="prose prose-lg max-w-none mb-12">
                {!! $article->konten !!}
            </div>

            <div class="flex gap-3 mb-12">
                <button onclick="copyShareLink()" class="flex items-center gap-2 px-4 py-2 rounded-full border border-gray-300 hover:bg-gray-100 transition shadow-sm">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12v.01M12 4v.01M20 12v.01M12 20v.01M8.59 16.59L16.59 8.59M8.59 8.59l8 8"/></svg>
                    <span class="font-medium text-gray-700">Share</span>
                </button>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="flex items-center gap-2 px-4 py-2 rounded-full border border-blue-500 hover:bg-blue-50 transition shadow-sm">
                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35C.6 0 0 .6 0 1.326v21.348C0 23.4.6 24 1.326 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.797.143v3.24l-1.918.001c-1.504 0-1.797.715-1.797 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.104C23.4 24 24 23.4 24 22.674V1.326C24 .6 23.4 0 22.675 0"/></svg>
                    <span class="font-medium text-blue-700">Facebook</span>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($article->judul) }}" target="_blank" class="flex items-center gap-2 px-4 py-2 rounded-full border border-blue-400 hover:bg-blue-50 transition shadow-sm">
                    <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53A4.48 4.48 0 0022.4.36a9.09 9.09 0 01-2.88 1.1A4.52 4.52 0 0016.11 0c-2.53 0-4.59 2.06-4.59 4.59 0 .36.04.71.11 1.05C7.69 5.5 4.07 3.7 1.64.9c-.4.68-.63 1.47-.63 2.32 0 1.6.81 3.01 2.05 3.84A4.48 4.48 0 01.96 6.1v.06c0 2.23 1.59 4.09 3.7 4.52-.39.11-.8.17-1.22.17-.3 0-.59-.03-.87-.08.59 1.85 2.3 3.2 4.33 3.24A9.05 9.05 0 010 21.54a12.8 12.8 0 006.92 2.03c8.3 0 12.84-6.88 12.84-12.84 0-.2 0-.39-.01-.58A9.22 9.22 0 0024 4.59a9.13 9.13 0 01-2.59.71z"/></svg>
                    <span class="font-medium text-blue-500">Twitter</span>
                </a>
            </div>
            <script>
            function copyShareLink() {
                navigator.clipboard.writeText(window.location.href);
                alert('Link artikel telah disalin!');
            }
            </script>

            <div class="border-t pt-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Berita Terkait</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($recentArticles as $recentArticle)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            @if($recentArticle->gambar)
                                 <img src="{{ asset('storage/' . $recentArticle->gambar) }}" alt="{{ $article->judul }}" class="w-full h-56 object-cover">
                            @else
                                <div class="w-full h-40 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-400">No Image</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2">
                                {{ $recentArticle->judul }}
                            </h3>
                            <a href="{{ route('berita.show', $recentArticle->slug) }}" 
                               class="text-blue-600 hover:text-blue-800 font-medium">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
