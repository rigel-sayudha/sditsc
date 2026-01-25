@extends('admin.layouts.admin')

@section('title', $viewTitle)

@section('content')
<div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-green-700">{{ $viewTitle }}</h1>
            @if($isWeekend)
                <div class="mt-2 p-3 bg-blue-100 border border-blue-300 rounded">
                    <i class="fas fa-info-circle text-blue-600"></i>
                    <span class="ml-2 text-blue-700">Hari ini adalah akhir pekan. Menampilkan jadwal untuk minggu depan.</span>
                </div>
            @endif
        </div>
        <div class="space-x-2">
            <a href="{{ route('admin.test-schedules.calendar') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                <i class="fas fa-calendar mr-2"></i> Tampilan Kalender
            </a>
            <a href="{{ route('admin.test-schedules.create') }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                <i class="fas fa-plus mr-2"></i> Tambah Jadwal
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if($groupedSchedules->isEmpty())
        <div class="text-center py-12">
            <i class="fas fa-calendar-times text-6xl text-gray-400 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum ada jadwal tes</h3>
            <p class="text-gray-500 mb-6">Silakan tambahkan jadwal tes baru.</p>
            <a href="{{ route('admin.test-schedules.create') }}" class="inline-block px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-plus mr-2"></i> Tambah Jadwal
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($groupedSchedules as $date => $schedules)
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                    <div class="bg-green-600 text-white px-4 py-3">
                        <h3 class="font-semibold">
                            <i class="fas fa-calendar-day mr-2"></i>
                            {{ $schedules->first()->day_name }}
                        </h3>
                        <p class="text-green-100 text-sm">{{ Carbon\Carbon::parse($date)->format('d F Y') }}</p>
                    </div>

                    <div class="divide-y divide-gray-100">
                        @foreach($schedules as $schedule)
                            <div class="p-4 {{ !$schedule->is_active ? 'bg-gray-50' : '' }}">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <div class="flex items-center mb-2">
                                            <i class="fas fa-clock text-green-600 mr-2"></i>
                                            <span class="font-semibold text-gray-800">
                                                {{ Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - 
                                                {{ Carbon\Carbon::parse($schedule->end_time)->format('H:i') }} WIB
                                            </span>
                                            @if(!$schedule->is_active)
                                                <span class="ml-2 px-2 py-1 bg-gray-500 text-white text-xs rounded">Nonaktif</span>
                                            @endif
                                        </div>
                                        
                                        @if($schedule->max_participants)
                                            <div class="mb-2">
                                                <i class="fas fa-users text-blue-600 mr-2"></i>
                                                <span class="text-sm text-gray-600">
                                                    {{ $schedule->registrations->count() }} / {{ $schedule->max_participants }} peserta
                                                </span>
                                                @if($schedule->isFull())
                                                    <span class="ml-2 px-2 py-1 bg-yellow-500 text-white text-xs rounded">Penuh</span>
                                                @endif
                                            </div>
                                        @endif

                                        @if($schedule->notes)
                                            <div class="mb-2">
                                                <i class="fas fa-sticky-note text-yellow-600 mr-2"></i>
                                                <span class="text-sm text-gray-600">{{ $schedule->notes }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="relative ml-4">
                                        <button class="p-2 text-gray-400 hover:text-gray-600" onclick="toggleDropdown('dropdown-{{ $schedule->id }}')">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div id="dropdown-{{ $schedule->id }}" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-10">
                                            <a href="{{ route('admin.test-schedules.show', $schedule) }}" 
                                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <i class="fas fa-eye mr-2"></i> Lihat Detail
                                            </a>
                                            <a href="{{ route('admin.test-schedules.edit', $schedule) }}" 
                                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <i class="fas fa-edit mr-2"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.test-schedules.toggle-status', $schedule) }}" 
                                                  method="POST" class="block">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                    @if($schedule->is_active)
                                                        <i class="fas fa-toggle-off mr-2"></i> Nonaktifkan
                                                    @else
                                                        <i class="fas fa-toggle-on mr-2"></i> Aktifkan
                                                    @endif
                                                </button>
                                            </form>
                                            <div class="border-t border-gray-100"></div>
                                            <form action="{{ route('admin.test-schedules.destroy', $schedule) }}" 
                                                  method="POST" class="block"
                                                  onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                                    <i class="fas fa-trash mr-2"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<script>
function toggleDropdown(id) {
    // Close all other dropdowns
    document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
        if (dropdown.id !== id) {
            dropdown.classList.add('hidden');
        }
    });
    
    // Toggle current dropdown
    const dropdown = document.getElementById(id);
    dropdown.classList.toggle('hidden');
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('[onclick*="toggleDropdown"]')) {
        document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
            dropdown.classList.add('hidden');
        });
    }
});
</script>
@endsection
