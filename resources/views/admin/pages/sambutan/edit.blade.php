@extends('admin.layouts.admin')

@section('title', 'Edit Sambutan Kepala Sekolah')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Sambutan Kepala Sekolah</h1>
    <form action="{{ route('admin.sambutan.update', $sambutan) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg max-w-xl mx-auto space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label class="block font-medium mb-2">Nama Kepala Sekolah</label>
            <input type="text" name="nama_kepala" class="w-full border border-gray-300 rounded px-4 py-2" required value="{{ old('nama_kepala', $sambutan->nama_kepala) }}">
        </div>
        <div>
            <label class="block font-medium mb-2">Jabatan</label>
            <input type="text" name="jabatan" class="w-full border border-gray-300 rounded px-4 py-2" value="{{ old('jabatan', $sambutan->jabatan) }}">
        </div>
        <div>
            <label class="block font-medium mb-2">Foto Kepala Sekolah</label>
            @if($sambutan->foto)
                <img src="{{ asset('storage/' . $sambutan->foto) }}" alt="Foto" class="w-24 h-24 object-cover rounded mb-2">
            @endif
            <input type="file" name="foto" class="w-full border border-gray-300 rounded px-4 py-2">
        </div>
        <div>
            <label class="block font-medium mb-2">Isi Sambutan</label>
            <textarea name="isi" rows="6" class="w-full border border-gray-300 rounded px-4 py-2" required>{{ old('isi', $sambutan->isi) }}</textarea>
        </div>
        <div>
            <label class="block font-medium mb-2">Status</label>
            <select name="status" class="w-full border border-gray-300 rounded px-4 py-2">
                <option value="published" {{ old('status', $sambutan->status)=='published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ old('status', $sambutan->status)=='draft' ? 'selected' : '' }}>Draft</option>
            </select>
        </div>
        <div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update</button>
            <a href="{{ route('admin.sambutan.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection
