@extends('admin.layouts.admin')

@section('title', 'Kelola Profil')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Kelola Profil Admin</h2>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif
    
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        <div class="flex flex-col items-center mb-6">
            @php
                $avatarUrl = Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('images/logo.png');
            @endphp
            <img src="{{ $avatarUrl }}" alt="Avatar" class="w-24 h-24 rounded-full mb-2 object-cover border-2 border-gray-200" onerror="this.src='{{ asset('images/logo.png') }}'">
            <label class="block">
                <span class="sr-only">Pilih Foto Profil</span>
                <input type="file" name="avatar" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
            </label>
            <span class="text-xs text-gray-500 mt-1">JPG, PNG, maksimal 2MB</span>
        </div>
        <div>
            <label class="block text-gray-700 font-medium mb-2" for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent" required>
        </div>
        <div>
            <label class="block text-gray-700 font-medium mb-2" for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent" required>
        </div>
        <div>
            <label class="block text-gray-700 font-medium mb-2" for="password">Password Baru <span class="text-gray-400 text-xs">(Opsional)</span></label>
            <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent">
        </div>
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
