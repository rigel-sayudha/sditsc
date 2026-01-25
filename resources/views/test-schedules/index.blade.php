@extends('layouts.app')

@section('title', $viewTitle)

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <div class="text-center mb-5">
                <h2 class="display-4 text-primary">{{ $viewTitle }}</h2>
                <p class="lead text-muted">{{ $weekInfo }}</p>
                
                @if($isWeekend)
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle mr-2"></i>
                        <strong>Informasi:</strong> Pendaftaran tes untuk minggu depan sudah dibuka!
                    </div>
                @endif
            </div>

            @if($groupedSchedules->isEmpty())
                <div class="text-center py-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body py-5">
                            <i class="fas fa-calendar-times fa-4x text-muted mb-4"></i>
                            <h4 class="text-muted">Belum Ada Jadwal Tersedia</h4>
                            <p class="text-muted mb-4">
                                @if($isWeekend)
                                    Jadwal tes untuk minggu depan belum tersedia. Silakan cek kembali nanti.
                                @else
                                    Tidak ada jadwal tes yang tersedia untuk saat ini.
                                @endif
                            </p>
                            <a href="{{ route('home') }}" class="btn btn-primary">
                                <i class="fas fa-home mr-2"></i> Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    @foreach($groupedSchedules as $date => $schedules)
                        <div class="col-lg-6 col-xl-4 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-header bg-gradient-primary text-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-calendar-day mr-2"></i>
                                        {{ $schedules->first()->day_name }}
                                    </h5>
                                    <small>{{ Carbon\Carbon::parse($date)->format('d F Y') }}</small>
                                </div>

                                <div class="card-body p-0">
                                    @foreach($schedules as $schedule)
                                        <div class="p-3 border-bottom last:border-bottom-0">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div class="flex-grow-1">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="fas fa-clock text-primary mr-2"></i>
                                                        <strong class="text-dark">
                                                            {{ Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - 
                                                            {{ Carbon\Carbon::parse($schedule->end_time)->format('H:i') }} WIB
                                                        </strong>
                                                    </div>

                                                    @if($schedule->max_participants)
                                                        <div class="mb-2">
                                                            <i class="fas fa-users text-info mr-2"></i>
                                                            <small class="text-muted">
                                                                Tersisa {{ $schedule->max_participants - $schedule->registrations->count() }} 
                                                                dari {{ $schedule->max_participants }} tempat
                                                            </small>
                                                            
                                                            <div class="progress mt-1" style="height: 4px;">
                                                                @php
                                                                    $percentage = ($schedule->registrations->count() / $schedule->max_participants) * 100;
                                                                @endphp
                                                                <div class="progress-bar" 
                                                                     style="width: {{ $percentage }}%; background-color: {{ $percentage > 80 ? '#ffc107' : '#28a745' }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if($schedule->notes)
                                                        <div class="mb-2">
                                                            <i class="fas fa-sticky-note text-warning mr-2"></i>
                                                            <small class="text-muted">{{ $schedule->notes }}</small>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="ml-3">
                                                    @if($schedule->isFull())
                                                        <span class="badge badge-warning">Penuh</span>
                                                    @else
                                                        <span class="badge badge-success">Tersedia</span>
                                                    @endif
                                                </div>
                                            </div>

                                            @if(!$schedule->isFull())
                                                <div class="mt-3">
                                                    <a href="{{ route('pendaftaran') }}?schedule={{ $schedule->id }}" 
                                                       class="btn btn-primary btn-sm btn-block">
                                                        <i class="fas fa-user-plus mr-2"></i>
                                                        Daftar Jadwal Ini
                                                    </a>
                                                </div>
                                            @else
                                                <div class="mt-3">
                                                    <button class="btn btn-secondary btn-sm btn-block" disabled>
                                                        <i class="fas fa-times mr-2"></i>
                                                        Jadwal Penuh
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card border-info">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Informasi Penting
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6><i class="fas fa-clock text-primary mr-2"></i>Waktu Pendaftaran</h6>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-chevron-right text-success mr-2"></i>Datang 30 menit sebelum tes dimulai</li>
                                            <li><i class="fas fa-chevron-right text-success mr-2"></i>Bawa dokumen pendukung yang diperlukan</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <h6><i class="fas fa-file-alt text-primary mr-2"></i>Dokumen Yang Diperlukan</h6>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-chevron-right text-success mr-2"></i>Kartu identitas</li>
                                            <li><i class="fas fa-chevron-right text-success mr-2"></i>Bukti pendaftaran online</li>
                                        </ul>
                                    </div>
                                </div>
                                
                                @if($isWeekend)
                                    <div class="alert alert-warning mt-3 mb-0">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        <strong>Catatan:</strong> Jadwal tes untuk hari Sabtu dan Minggu tidak tersedia. 
                                        Silakan pilih jadwal pada hari kerja (Senin-Jumat).
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('pendaftaran') }}" class="btn btn-success btn-lg">
                        <i class="fas fa-edit mr-2"></i>
                        Mulai Pendaftaran
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-outline-primary btn-lg ml-3">
                        <i class="fas fa-home mr-2"></i>
                        Kembali ke Beranda
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}

.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
}

.progress {
    border-radius: 2px;
}

.badge {
    font-size: 0.75em;
}

@media (max-width: 768px) {
    .display-4 {
        font-size: 2rem;
    }
    
    .btn-lg {
        font-size: 1rem;
        padding: 0.75rem 1.5rem;
    }
}
</style>
@endpush
@endsection
