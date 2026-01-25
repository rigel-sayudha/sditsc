@extends('admin.layouts.admincreate')
@section('title')
Tambah Foto/Video Galeri
@endsection
@section('content')
<div class="max-w-xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold text-green-700 mb-8">Tambah Foto/Video Kegiatan</h1>
    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div>
            <label class="block font-semibold mb-2">Judul</label>
            <input type="text" name="judul" class="w-full border rounded px-4 py-2" required>
        </div>
        <div>
            <label class="block font-semibold mb-2">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border rounded px-4 py-2" rows="3" required></textarea>
        </div>
        <div>
            <label class="block font-semibold mb-2">Tipe</label>
            <select name="tipe" class="w-full border rounded px-4 py-2" required>
                <option value="foto">Foto</option>
                <option value="video">Video</option>
            </select>
        </div>
        <div>
            <label class="block font-semibold mb-2">File Foto/Video</label>
            <input type="file" name="file" class="w-full border rounded px-4 py-2" required accept="image/*,video/mp4">
        </div>
        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 font-semibold">Simpan</button>
    </form>
</div>
@endsection
