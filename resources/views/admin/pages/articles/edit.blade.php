@extends('admin.layouts.adminedit')

@section('title', 'Edit Berita')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Edit Berita</h1>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="judul" class="block text-gray-700 font-medium mb-2">Judul Berita</label>
                    <input type="text" name="judul" id="judul" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('judul') border-red-500 @enderror"
                        value="{{ old('judul', $article->judul) }}" required>
                    @error('judul')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="konten" class="block text-gray-700 font-medium mb-2">Konten</label>
                    <textarea name="konten" id="konten" rows="10" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('konten') border-red-500 @enderror"
                        required>{{ old('konten', $article->konten) }}</textarea>
                    @error('konten')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="gambar" class="block text-gray-700 font-medium mb-2">Gambar</label>
                    @if($article->gambar)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $article->gambar) }}" alt="Current Image" class="w-48 h-auto">
                            <p class="text-sm text-gray-600 mt-1">Gambar saat ini</p>
                        </div>
                    @endif
                    <input type="file" name="gambar" id="gambar" accept="image/*"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('gambar') border-red-500 @enderror">
                    <p class="text-sm text-gray-600 mt-1">Biarkan kosong jika tidak ingin mengubah gambar</p>
                    @error('gambar')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="status" class="block text-gray-700 font-medium mb-2">Status</label>
                    <select name="status" id="status" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror"
                        required>
                        <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.articles.index') }}" 
                        class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Batal
                    </a>
                    <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#konten'))
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
@endsection
