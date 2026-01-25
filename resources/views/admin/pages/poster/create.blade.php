@extends('admin.layouts.admincreate')
@section('title', 'Tambah Poster Pop-up')
@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Poster Pop-up</h2>
    <form action="{{ route('admin.poster.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block font-semibold mb-2">Gambar Poster</label>
            <input type="file" name="gambar" accept="image/*" required class="w-full border rounded px-3 py-2">
            @error('gambar')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-2">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
            @error('status')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.poster.index') }}" class="px-4 py-2 bg-gray-300 rounded">Batal</a>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded shadow hover:bg-green-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
