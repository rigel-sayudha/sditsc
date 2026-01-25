@extends('admin.layouts.admin')
@section('title', 'Detail Artikel')
@section('content')
<div class="max-w-2xl mx-auto bg-white rounded shadow p-6">
    <h2 class="text-2xl font-bold mb-4">{{ $article->judul }}</h2>
    <div class="mb-4">
        <span class="inline-block px-3 py-1 rounded {{ $article->status == 'published' ? 'bg-green-600 text-white' : 'bg-gray-300 text-gray-700' }}">{{ ucfirst($article->status) }}</span>
        <span class="ml-2 text-sm text-gray-500">{{ $article->created_at ? $article->created_at->format('d M Y H:i') : '-' }}</span>
    </div>
    @if($article->gambar)
         <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-16 h-12 object-cover rounded">
    @endif
    <div class="prose max-w-none mb-6">{!! $article->konten !!}</div>
    <a href="{{ route('admin.articles.index') }}" class="px-4 py-2 bg-gray-300 rounded">Kembali</a>
</div>
@endsection
