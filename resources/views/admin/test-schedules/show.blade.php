@extends('admin.layouts.admin')

@section('title', 'Detail Jadwal Tes')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-green-700 mb-2">Detail Jadwal Tes</h1>
                <p class="text-gray-600">Informasi lengkap jadwal tes dan daftar peserta</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.test-schedules.edit', $testSchedule) }}" 
                   class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 transition">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <a href="{{ route('admin.test-schedules.index') }}" 
                   class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Schedule Information -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Jadwal</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm font-medium text-gray-600">Tanggal</label>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ \Carbon\Carbon::parse($testSchedule->date)->format('d F Y') }}
                            <span class="text-sm text-blue-600 ml-2">
                                ({{ \Carbon\Carbon::parse($testSchedule->date)->locale('id')->dayName }})
                            </span>
                        </p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm font-medium text-gray-600">Waktu</label>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ \Carbon\Carbon::parse($testSchedule->start_time)->format('H:i') }} - 
                            {{ \Carbon\Carbon::parse($testSchedule->end_time)->format('H:i') }} WIB
                        </p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm font-medium text-gray-600">Kapasitas Maksimal</label>
                        <p class="text-lg font-semibold text-gray-900">
                            @if($testSchedule->max_participants)
                                {{ $testSchedule->max_participants }} orang
                            @else
                                <span class="text-green-600">Tidak terbatas</span>
                            @endif
                        </p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm font-medium text-gray-600">Status</label>
                        <p class="text-lg font-semibold">
                            @if($testSchedule->is_active)
                                <span class="text-green-600">
                                    <i class="fas fa-check-circle mr-1"></i> Aktif
                                </span>
                            @else
                                <span class="text-red-600">
                                    <i class="fas fa-times-circle mr-1"></i> Nonaktif
                                </span>
                            @endif
                        </p>
                    </div>
                </div>

                @if($testSchedule->notes)
                <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <label class="text-sm font-medium text-gray-600">Catatan</label>
                    <p class="text-gray-800 mt-1">{{ $testSchedule->notes }}</p>
                </div>
                @endif
            </div>

            <!-- Participants List -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Daftar Peserta</h2>
                    @if($testSchedule->registrations->count() > 0)
                        <button onclick="exportParticipants()" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                            <i class="fas fa-download mr-2"></i> Export
                        </button>
                    @endif
                </div>

                @if($testSchedule->registrations->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. HP</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asal Sekolah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($testSchedule->registrations as $index => $registration)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $registration->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $registration->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $registration->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $registration->phone }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $registration->school_origin }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $registration->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button onclick="viewRegistration({{ $registration->id }})" 
                                                class="text-blue-600 hover:text-blue-900 mr-3">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button onclick="contactParticipant('{{ $registration->phone }}')" 
                                                class="text-green-600 hover:text-green-900">
                                            <i class="fab fa-whatsapp"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fas fa-users text-gray-400 text-4xl mb-4"></i>
                        <p class="text-gray-500 text-lg">Belum ada peserta yang mendaftar</p>
                        <p class="text-gray-400 text-sm">Peserta akan muncul di sini setelah melakukan pendaftaran</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Statistics Sidebar -->
        <div class="lg:col-span-1">
            <!-- Quick Stats -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Statistik Cepat</h3>
                <div class="space-y-4">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <div class="text-center">
                            <p class="text-3xl font-bold text-blue-600">{{ $testSchedule->registrations->count() }}</p>
                            <p class="text-sm text-gray-600">Total Pendaftar</p>
                        </div>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg">
                        <div class="text-center">
                            <p class="text-3xl font-bold text-green-600">
                                {{ $testSchedule->availableSlots() ?? '∞' }}
                            </p>
                            <p class="text-sm text-gray-600">Sisa Slot</p>
                        </div>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg">
                        <div class="text-center">
                            <p class="text-3xl font-bold text-purple-600">
                                {{ $testSchedule->registrations->where('gender', 'L')->count() }}
                            </p>
                            <p class="text-sm text-gray-600">Laki-laki</p>
                        </div>
                    </div>
                    <div class="bg-pink-50 p-4 rounded-lg">
                        <div class="text-center">
                            <p class="text-3xl font-bold text-pink-600">
                                {{ $testSchedule->registrations->where('gender', 'P')->count() }}
                            </p>
                            <p class="text-sm text-gray-600">Perempuan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.test-schedules.edit', $testSchedule) }}" 
                       class="w-full px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 transition text-center block">
                        <i class="fas fa-edit mr-2"></i> Edit Jadwal
                    </a>
                    <button onclick="toggleStatus()" 
                            class="w-full px-4 py-2 {{ $testSchedule->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} text-white rounded-md transition">
                        @if($testSchedule->is_active)
                            <i class="fas fa-pause mr-2"></i> Nonaktifkan
                        @else
                            <i class="fas fa-play mr-2"></i> Aktifkan
                        @endif
                    </button>
                    @if($testSchedule->registrations->count() > 0)
                        <button onclick="notifyParticipants()" 
                                class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                            <i class="fas fa-bell mr-2"></i> Kirim Notifikasi
                        </button>
                    @endif
                    <form action="{{ route('admin.test-schedules.destroy', $testSchedule) }}" 
                          method="POST" 
                          onsubmit="return confirm('Yakin ingin menghapus jadwal ini? Tindakan ini tidak dapat dibatalkan.')"
                          class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                            <i class="fas fa-trash mr-2"></i> Hapus Jadwal
                        </button>
                    </form>
                </div>
            </div>

            <!-- Schedule Info -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Info Jadwal</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Dibuat:</span>
                        <span class="text-gray-900">{{ $testSchedule->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Diupdate:</span>
                        <span class="text-gray-900">{{ $testSchedule->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Durasi:</span>
                        <span class="text-gray-900">
                            {{ \Carbon\Carbon::parse($testSchedule->start_time)->diffInMinutes(\Carbon\Carbon::parse($testSchedule->end_time)) }} menit
                        </span>
                    </div>
                    @if($testSchedule->max_participants)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Kapasitas:</span>
                            <span class="text-gray-900">
                                {{ round(($testSchedule->registrations->count() / $testSchedule->max_participants) * 100) }}% terisi
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleStatus() {
    if (confirm('Yakin ingin mengubah status jadwal ini?')) {
        // Implementation for toggling status
        window.location.href = "{{ route('admin.test-schedules.edit', $testSchedule) }}";
    }
}

function exportParticipants() {
    // Implementation for exporting participants
    alert('Fitur export akan segera tersedia!');
}

function viewRegistration(id) {
    // Implementation for viewing registration details
    alert('Melihat detail pendaftaran ID: ' + id);
}

function contactParticipant(phone) {
    // Open WhatsApp
    window.open('https://wa.me/62' + phone.replace(/^0/, ''), '_blank');
}

function notifyParticipants() {
    if (confirm('Kirim notifikasi ke semua peserta?')) {
        alert('Fitur notifikasi akan segera tersedia!');
    }
}
</script>
@endsection

@section('title', 'Detail Jadwal Tes')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Detail Jadwal Tes</h3>
                    <div>
                        <a href="{{ route('admin.test-schedules.edit', $testSchedule) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.test-schedules.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%"><strong>Tanggal:</strong></td>
                                    <td>{{ $testSchedule->day_name }}, {{ $testSchedule->date->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Waktu:</strong></td>
                                    <td>{{ $testSchedule->start_time->format('H:i') }} - {{ $testSchedule->end_time->format('H:i') }} WIB</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        @if($testSchedule->is_active)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-secondary">Nonaktif</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Kapasitas:</strong></td>
                                    <td>
                                        @if($testSchedule->max_participants)
                                            {{ $testSchedule->registrations->count() }} / {{ $testSchedule->max_participants }} peserta
                                            @if($testSchedule->isFull())
                                                <span class="badge badge-warning ml-1">Penuh</span>
                                            @endif
                                        @else
                                            {{ $testSchedule->registrations->count() }} peserta (tanpa batas)
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            @if($testSchedule->notes)
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0"><i class="fas fa-sticky-note"></i> Catatan</h6>
                                    </div>
                                    <div class="card-body">
                                        {{ $testSchedule->notes }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-chart-pie"></i> Statistik</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <div class="row">
                            <div class="col-6">
                                <div class="border-right">
                                    <h4 class="text-primary">{{ $testSchedule->registrations->count() }}</h4>
                                    <small class="text-muted">Total Peserta</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <h4 class="text-info">
                                    @if($testSchedule->max_participants)
                                        {{ $testSchedule->max_participants - $testSchedule->registrations->count() }}
                                    @else
                                        ∞
                                    @endif
                                </h4>
                                <small class="text-muted">Sisa Kuota</small>
                            </div>
                        </div>
                    </div>

                    @if($testSchedule->max_participants)
                        <div class="mt-3">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" 
                                     style="width: {{ ($testSchedule->registrations->count() / $testSchedule->max_participants) * 100 }}%">
                                    {{ round(($testSchedule->registrations->count() / $testSchedule->max_participants) * 100) }}%
                                </div>
                            </div>
                            <small class="text-muted">Tingkat pengisian</small>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-cogs"></i> Aksi Cepat</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.test-schedules.toggle-status', $testSchedule) }}" method="POST" class="mb-2">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-block {{ $testSchedule->is_active ? 'btn-warning' : 'btn-success' }}">
                            @if($testSchedule->is_active)
                                <i class="fas fa-toggle-off"></i> Nonaktifkan Jadwal
                            @else
                                <i class="fas fa-toggle-on"></i> Aktifkan Jadwal
                            @endif
                        </button>
                    </form>

                    @if($testSchedule->registrations->count() == 0)
                        <form action="{{ route('admin.test-schedules.destroy', $testSchedule) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-block btn-danger">
                                <i class="fas fa-trash"></i> Hapus Jadwal
                            </button>
                        </form>
                    @else
                        <button class="btn btn-block btn-danger" disabled title="Tidak dapat menghapus jadwal yang sudah memiliki peserta">
                            <i class="fas fa-trash"></i> Hapus Jadwal
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($testSchedule->registrations->count() > 0)
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-users"></i> Daftar Peserta ({{ $testSchedule->registrations->count() }})</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th width="15%">Tanggal Lahir</th>
                                        <th width="10%">Jenis Kelamin</th>
                                        <th width="15%">Tanggal Daftar</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($testSchedule->registrations as $registration)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <strong>{{ $registration->nama }}</strong>
                                                @if($registration->email)
                                                    <br><small class="text-muted">{{ $registration->email }}</small>
                                                @endif
                                            </td>
                                            <td>{{ $registration->nik }}</td>
                                            <td>{{ $registration->tempat_lahir }}, {{ \Carbon\Carbon::parse($registration->tanggal_lahir)->format('d/m/Y') }}</td>
                                            <td>
                                                <span class="badge {{ $registration->jenis_kelamin == 'L' ? 'badge-primary' : 'badge-pink' }}">
                                                    {{ $registration->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                                </span>
                                            </td>
                                            <td>{{ $registration->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-info" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show position-fixed" 
         style="top: 20px; right: 20px; z-index: 9999;" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
@endif
@endsection
