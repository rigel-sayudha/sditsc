@extends('admin.layouts.adminedit')

@section('title', 'Edit Ekstrakurikuler')

@section('content')
<div class="container mx-auto py-6">
    <h2 class="text-2xl font-bold mb-6">Edit Ekstrakurikuler</h2>
    <form action="{{ route('admin.ekstrakurikuler.update', $ekstrakurikuler) }}" method="POST" enctype="multipart/form-data" class="max-w-xl bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block font-semibold mb-1">Nama</label>
            <input type="text" name="nama" class="w-full border rounded px-3 py-2" required value="{{ old('nama', $ekstrakurikuler->nama) }}">
            @error('nama')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border rounded px-3 py-2" rows="4">{{ old('deskripsi', $ekstrakurikuler->deskripsi) }}</textarea>
            @error('deskripsi')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Foto</label>
            @if($ekstrakurikuler->foto)
                <img src="{{ asset('storage/' . $ekstrakurikuler->foto) }}" alt="foto" class="h-16 w-16 object-cover rounded mb-2">
            @endif
            <input type="file" name="foto" class="w-full border rounded px-3 py-2" accept="image/*">
            @error('foto')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4 flex items-center">
            <input type="checkbox" name="is_active" id="is_active" class="mr-2" value="1" {{ old('is_active', $ekstrakurikuler->is_active) ? 'checked' : '' }}>
            <label for="is_active">Aktif</label>
        </div>
        <div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
            <a href="{{ route('admin.ekstrakurikuler.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection
