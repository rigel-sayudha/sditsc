@extends('admin.layouts.admincreate')

@section('title', 'Tambah Ekstrakurikuler')

@section('content')
<!-- Tailwind CDN for style support -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<div class="container mx-auto py-6">
    <h2 class="text-2xl font-bold mb-6">Tambah Ekstrakurikuler</h2>
    <form action="{{ route('admin.ekstrakurikuler.store') }}" method="POST" enctype="multipart/form-data" class="max-w-xl bg-white p-6 rounded shadow">
        @csrf
        <div class="mb-4">
            <label class="block font-semibold mb-1">Nama</label>
            <input type="text" name="nama" class="w-full border rounded px-3 py-2" required value="{{ old('nama') }}">
            @error('nama')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border rounded px-3 py-2" rows="4">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Foto</label>
            <input type="file" name="foto" class="w-full border rounded px-3 py-2" accept="image/*">
            @error('foto')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4 flex items-center">
            <input type="checkbox" name="is_active" id="is_active" class="mr-2" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
            <label for="is_active">Aktif</label>
        </div>
        <div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
            <a href="{{ route('admin.ekstrakurikuler.index') }}" class="ml-2 px-4 py-2 rounded bg-yellow-400 text-gray-900 font-semibold shadow hover:bg-yellow-500 transition-colors duration-150">Batal</a>
        </div>
    </form>
</div>
@endsection