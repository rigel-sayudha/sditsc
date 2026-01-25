@extends('admin.layouts.admin')

@section('title', 'Tambah Jadwal Tes')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-green-700 mb-2">Tambah Jadwal Tes</h1>
        <p class="text-gray-600">Buat jadwal tes baru untuk calon siswa</p>
    </div>

    <form action="{{ route('admin.test-schedules.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Tanggal -->
            <div class="md:col-span-1">
                <label for="date" class="block text-sm font-medium text-gray-700 mb-2">
                    Tanggal <span class="text-red-500">*</span>
                </label>
                <input type="date" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('date') border-red-500 @enderror" 
                       id="date" 
                       name="date" 
                       value="{{ old('date') }}"
                       min="{{ date('Y-m-d') }}">
                @error('date')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Waktu Mulai -->
            <div class="md:col-span-1">
                <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">
                    Waktu Mulai <span class="text-red-500">*</span>
                </label>
                <input type="time" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('start_time') border-red-500 @enderror" 
                       id="start_time" 
                       name="start_time" 
                       value="{{ old('start_time') }}">
                @error('start_time')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Waktu Selesai -->
            <div class="md:col-span-1">
                <label for="end_time" class="block text-sm font-medium text-gray-700 mb-2">
                    Waktu Selesai <span class="text-red-500">*</span>
                </label>
                <input type="time" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('end_time') border-red-500 @enderror" 
                       id="end_time" 
                       name="end_time" 
                       value="{{ old('end_time') }}">
                @error('end_time')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Maksimal Peserta -->
            <div class="md:col-span-1">
                <label for="max_participants" class="block text-sm font-medium text-gray-700 mb-2">
                    Maksimal Peserta
                </label>
                <input type="number" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('max_participants') border-red-500 @enderror" 
                       id="max_participants" 
                       name="max_participants" 
                       value="{{ old('max_participants') }}"
                       min="1"
                       placeholder="Kosongkan jika tidak ada batas">
                @error('max_participants')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Kosongkan jika tidak ingin membatasi jumlah peserta</p>
            </div>

            <!-- Status Aktif -->
            <div class="md:col-span-2">
                <div class="flex items-center">
                    <input type="checkbox" 
                           class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded" 
                           id="is_active" 
                           name="is_active" 
                           {{ old('is_active', true) ? 'checked' : '' }}>
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">
                        Jadwal Aktif
                    </label>
                </div>
                <p class="mt-1 text-sm text-gray-500">Hanya jadwal aktif yang dapat dipilih oleh calon siswa</p>
            </div>

            <!-- Catatan -->
            <div class="md:col-span-2">
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                    Catatan
                </label>
                <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('notes') border-red-500 @enderror" 
                          id="notes" 
                          name="notes" 
                          rows="3"
                          placeholder="Catatan tambahan untuk jadwal ini (opsional)">{{ old('notes') }}</textarea>
                @error('notes')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Tips -->
        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <div class="flex">
                <i class="fas fa-info-circle text-blue-600 mr-3 mt-1"></i>
                <div>
                    <h4 class="text-blue-800 font-semibold mb-2">Tips Penggunaan:</h4>
                    <ul class="text-blue-700 text-sm space-y-1">
                        <li>• Jadwal yang tidak aktif tidak akan ditampilkan kepada calon siswa</li>
                        <li>• Anda dapat menonaktifkan jadwal kapan saja untuk hari libur atau acara khusus</li>
                        <li>• Batasan peserta membantu mengatur kapasitas ruang tes</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="mt-8 flex space-x-4">
            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                <i class="fas fa-save mr-2"></i> Simpan Jadwal
            </button>
            <a href="{{ route('admin.test-schedules.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition">
                <i class="fas fa-times mr-2"></i> Batal
            </a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-fill end time when start time is selected
    const startTimeInput = document.getElementById('start_time');
    const endTimeInput = document.getElementById('end_time');
    
    startTimeInput.addEventListener('change', function() {
        if (this.value && !endTimeInput.value) {
            const startTime = new Date('2000-01-01 ' + this.value);
            startTime.setHours(startTime.getHours() + 2); // Default 2 hours duration
            const endTime = startTime.toTimeString().slice(0, 5);
            endTimeInput.value = endTime;
        }
    });

    // Show day name when date is selected
    const dateInput = document.getElementById('date');
    dateInput.addEventListener('change', function() {
        if (this.value) {
            const date = new Date(this.value);
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const dayName = days[date.getDay()];
            
            // Show day name below date input
            let dayInfo = document.getElementById('day-info');
            if (!dayInfo) {
                dayInfo = document.createElement('p');
                dayInfo.id = 'day-info';
                dayInfo.className = 'mt-1 text-sm text-blue-600';
                dateInput.parentNode.appendChild(dayInfo);
            }
            dayInfo.innerHTML = '<i class="fas fa-calendar mr-1"></i> Hari: ' + dayName;
        }
    });
});
</script>
@endsection

@section('title', 'Tambah Jadwal Tes')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Jadwal Tes</h3>
                </div>

                <form action="{{ route('admin.test-schedules.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date">Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" 
                                           class="form-control @error('date') is-invalid @enderror" 
                                           id="date" 
                                           name="date" 
                                           value="{{ old('date') }}"
                                           min="{{ date('Y-m-d') }}">
                                    @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="start_time">Waktu Mulai <span class="text-danger">*</span></label>
                                    <input type="time" 
                                           class="form-control @error('start_time') is-invalid @enderror" 
                                           id="start_time" 
                                           name="start_time" 
                                           value="{{ old('start_time') }}">
                                    @error('start_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="end_time">Waktu Selesai <span class="text-danger">*</span></label>
                                    <input type="time" 
                                           class="form-control @error('end_time') is-invalid @enderror" 
                                           id="end_time" 
                                           name="end_time" 
                                           value="{{ old('end_time') }}">
                                    @error('end_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="max_participants">Maksimal Peserta</label>
                                    <input type="number" 
                                           class="form-control @error('max_participants') is-invalid @enderror" 
                                           id="max_participants" 
                                           name="max_participants" 
                                           value="{{ old('max_participants') }}"
                                           min="1"
                                           placeholder="Kosongkan jika tidak ada batas">
                                    @error('max_participants')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Kosongkan jika tidak ingin membatasi jumlah peserta</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-check mt-4">
                                        <input type="checkbox" 
                                               class="form-check-input" 
                                               id="is_active" 
                                               name="is_active" 
                                               {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Jadwal Aktif
                                        </label>
                                    </div>
                                    <small class="form-text text-muted">Hanya jadwal aktif yang dapat dipilih oleh calon siswa</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="notes">Catatan</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" 
                                      name="notes" 
                                      rows="3"
                                      placeholder="Catatan tambahan untuk jadwal ini (opsional)">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            <strong>Tips:</strong>
                            <ul class="mb-0 mt-2">
                                <li>Jadwal yang tidak aktif tidak akan ditampilkan kepada calon siswa</li>
                                <li>Anda dapat menonaktifkan jadwal kapan saja untuk hari libur atau acara khusus</li>
                                <li>Batasan peserta membantu mengatur kapasitas ruang tes</li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Jadwal
                        </button>
                        <a href="{{ route('admin.test-schedules.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Auto-fill end time when start time is selected
    $('#start_time').on('change', function() {
        if (this.value && !$('#end_time').val()) {
            const startTime = new Date('2000-01-01 ' + this.value);
            startTime.setHours(startTime.getHours() + 2); // Default 2 hours duration
            const endTime = startTime.toTimeString().slice(0, 5);
            $('#end_time').val(endTime);
        }
    });

    // Show day name when date is selected
    $('#date').on('change', function() {
        if (this.value) {
            const date = new Date(this.value);
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const dayName = days[date.getDay()];
            
            // Show day name below date input
            let dayInfo = $('#day-info');
            if (dayInfo.length === 0) {
                dayInfo = $('<small id="day-info" class="form-text text-info"></small>');
                $('#date').after(dayInfo);
            }
            dayInfo.html('<i class="fas fa-calendar"></i> Hari: ' + dayName);
        }
    });
});
</script>
@endpush
@endsection
