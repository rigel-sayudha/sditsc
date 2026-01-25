@extends('admin.layouts.admin')

@section('title', 'Sambutan Kepala Sekolah')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Manajemen Sambutan Kepala Sekolah</h1>
    <a href="{{ route('admin.sambutan.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Sambutan</a>
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    <div class="bg-white p-6 rounded-lg shadow-lg overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-6 text-left">Nama Kepala</th>
                    <th class="py-3 px-6 text-left">Jabatan</th>
                    <th class="py-3 px-6 text-left">Status</th>
                    <th class="py-3 px-6 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sambutans as $sambutan)
                <tr class="hover:bg-gray-100">
                    <td class="py-3 px-6 flex items-center space-x-4">
                        @if($sambutan->foto)
                            <img src="{{ asset('storage/' . $sambutan->foto) }}" alt="{{ $sambutan->nama_kepala }}" class="w-16 h-16 object-cover rounded-full">
                        @else
                            <div class="w-16 h-16 bg-gray-200 flex items-center justify-center rounded-full">
                                <span class="text-gray-400 text-xs">No Image</span>
                            </div>
                        @endif
                        <span>{{ $sambutan->nama_kepala }}</span>
                    </td>
                    <td class="py-3 px-6">{{ $sambutan->jabatan }}</td>
                    <td class="py-3 px-6 capitalize">{{ $sambutan->status }}</td>
                    <td class="py-3 px-6 space-x-2">
                        <a href="{{ route('admin.sambutan.edit', $sambutan) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('admin.sambutan.destroy', $sambutan) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus sambutan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Belum ada sambutan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">{{ $sambutans->links() }}</div>
    </div>
</div>
@endsection
