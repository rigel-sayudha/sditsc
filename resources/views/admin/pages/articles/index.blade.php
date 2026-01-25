@extends('admin.layouts.admin')

@section('title', 'Manajemen Berita')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Manajemen Berita Sekolah</h1>

    <a href="{{ route('admin.articles.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Tambah Berita Baru
    </a>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow-lg overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-6 text-left">Judul</th>
                    <th class="py-3 px-6 text-left">Status</th>
                    <th class="py-3 px-6 text-left">Tanggal Dibuat</th>
                    <th class="py-3 px-6 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($articles as $article) 
                <tr class="hover:bg-gray-100">
                <td class="py-3 px-6 flex items-center space-x-4">
                    @if($article->gambar)
                        <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-16 h-12 object-cover rounded">
                    @else
                        <div class="w-16 h-12 bg-gray-200 flex items-center justify-center rounded">
                            <span class="text-gray-400 text-xs">No Image</span>
                        </div>
                    @endif
                    <span>{{ $article->judul }}</span>
                </td>
                <td class="py-3 px-6 capitalize">{{ $article->status }}</td>
                <td class="py-3 px-6">{{ $article->created_at->format('d M Y') }}</td>
                <td class="py-3 px-6 space-x-2">
                    <a href="{{ route('admin.articles.edit', $article) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Hapus</button>
                    </form>
                </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Belum ada berita.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    </div>
</div>
@endsection
