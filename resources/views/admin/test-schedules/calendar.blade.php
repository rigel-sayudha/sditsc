@extends('admin.layouts.admin')

@section('title', 'Kalender Jadwal Tes')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-green-700 mb-2">Kalender Jadwal Tes</h1>
                <p class="text-gray-600">Lihat semua jadwal tes dalam tampilan kalender</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.test-schedules.create') }}" 
                   class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                    <i class="fas fa-plus mr-2"></i> Tambah Jadwal
                </a>
                <a href="{{ route('admin.test-schedules.index') }}" 
                   class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">
                    <i class="fas fa-list mr-2"></i> Tampilan List
                </a>
            </div>
        </div>
    </div>

    <!-- Calendar Navigation -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center space-x-4">
                <button onclick="previousMonth()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <h2 id="currentMonth" class="text-xl font-semibold text-gray-800"></h2>
                <button onclick="nextMonth()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            <div class="flex items-center space-x-2">
                <button onclick="goToToday()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    Hari Ini
                </button>
            </div>
        </div>

        <!-- Calendar Grid -->
        <div class="grid grid-cols-7 gap-1">
            <!-- Days of Week Header -->
            <div class="p-3 text-center font-semibold text-gray-600 bg-gray-50">Minggu</div>
            <div class="p-3 text-center font-semibold text-gray-600 bg-gray-50">Senin</div>
            <div class="p-3 text-center font-semibold text-gray-600 bg-gray-50">Selasa</div>
            <div class="p-3 text-center font-semibold text-gray-600 bg-gray-50">Rabu</div>
            <div class="p-3 text-center font-semibold text-gray-600 bg-gray-50">Kamis</div>
            <div class="p-3 text-center font-semibold text-gray-600 bg-gray-50">Jumat</div>
            <div class="p-3 text-center font-semibold text-gray-600 bg-gray-50">Sabtu</div>
            
            <!-- Calendar Days -->
            <div id="calendarGrid" class="col-span-7 grid grid-cols-7 gap-1">
                <!-- Will be filled by JavaScript -->
            </div>
        </div>
    </div>

    <!-- Legend -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Keterangan</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="flex items-center">
                <div class="w-4 h-4 bg-green-100 border-l-4 border-green-500 mr-3"></div>
                <span class="text-sm text-gray-600">Jadwal Aktif</span>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 bg-gray-100 border-l-4 border-gray-400 mr-3"></div>
                <span class="text-sm text-gray-600">Jadwal Nonaktif</span>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 bg-red-100 border-l-4 border-red-500 mr-3"></div>
                <span class="text-sm text-gray-600">Kapasitas Penuh</span>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 bg-blue-100 border-l-4 border-blue-500 mr-3"></div>
                <span class="text-sm text-gray-600">Hari Ini</span>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-center">
                <i class="fas fa-calendar-alt text-blue-600 text-3xl mb-3"></i>
                <p class="text-2xl font-bold text-blue-600">{{ $testSchedules->count() }}</p>
                <p class="text-sm text-gray-600">Total Jadwal</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-center">
                <i class="fas fa-check-circle text-green-600 text-3xl mb-3"></i>
                <p class="text-2xl font-bold text-green-600">{{ $testSchedules->where('is_active', true)->count() }}</p>
                <p class="text-sm text-gray-600">Jadwal Aktif</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-center">
                <i class="fas fa-users text-purple-600 text-3xl mb-3"></i>
                <p class="text-2xl font-bold text-purple-600">{{ $testSchedules->sum(function($schedule) { return $schedule->registrations->count(); }) }}</p>
                <p class="text-sm text-gray-600">Total Pendaftar</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-center">
                <i class="fas fa-calendar-week text-orange-600 text-3xl mb-3"></i>
                <p class="text-2xl font-bold text-orange-600">{{ $testSchedules->where('date', '>=', now())->count() }}</p>
                <p class="text-sm text-gray-600">Jadwal Mendatang</p>
            </div>
        </div>
    </div>
</div>

<!-- Schedule Detail Modal -->
<div id="scheduleModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Detail Jadwal</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="modalContent" class="mt-2 text-sm text-gray-600">
                <!-- Modal content will be inserted here -->
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button onclick="editSchedule()" id="editBtn" class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 transition">
                    <i class="fas fa-edit mr-1"></i> Edit
                </button>
                <button onclick="viewDetails()" id="viewBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    <i class="fas fa-eye mr-1"></i> Detail
                </button>
                <button onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let currentDate = new Date();
let selectedScheduleId = null;

// Test schedules data from PHP
const testSchedules = {!! json_encode($testSchedules->map(function($schedule) {
    return [
        'id' => $schedule->id,
        'date' => $schedule->date->format('Y-m-d'),
        'start_time' => $schedule->start_time->format('H:i:s'),
        'end_time' => $schedule->end_time->format('H:i:s'),
        'max_participants' => $schedule->max_participants,
        'is_active' => $schedule->is_active,
        'registrations_count' => $schedule->registrations->count(),
        'notes' => $schedule->notes
    ];
})) !!};

function renderCalendar() {
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    
    // Update month display
    const monthNames = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    document.getElementById('currentMonth').textContent = `${monthNames[month]} ${year}`;
    
    // Get first day of month and number of days
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const daysInMonth = lastDay.getDate();
    const startingDayOfWeek = firstDay.getDay();
    
    const calendarGrid = document.getElementById('calendarGrid');
    calendarGrid.innerHTML = '';
    
    // Add empty cells for days before the first day of the month
    for (let i = 0; i < startingDayOfWeek; i++) {
        const emptyDiv = document.createElement('div');
        emptyDiv.className = 'h-24 border border-gray-200 bg-gray-50';
        calendarGrid.appendChild(emptyDiv);
    }
    
    // Add days of the month
    for (let day = 1; day <= daysInMonth; day++) {
        const dayDiv = document.createElement('div');
        dayDiv.className = 'h-24 border border-gray-200 bg-white relative cursor-pointer hover:bg-gray-50';
        
        const currentDateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        const today = new Date().toISOString().split('T')[0];
        
        // Check if this is today
        if (currentDateStr === today) {
            dayDiv.classList.add('bg-blue-50', 'border-blue-300');
        }
        
        // Add day number
        const dayNumber = document.createElement('div');
        dayNumber.className = 'absolute top-1 left-2 text-sm font-medium text-gray-900';
        dayNumber.textContent = day;
        dayDiv.appendChild(dayNumber);
        
        // Find schedules for this day
        const daySchedules = testSchedules.filter(schedule => schedule.date === currentDateStr);
        
        // Add schedules to day
        if (daySchedules.length > 0) {
            const schedulesContainer = document.createElement('div');
            schedulesContainer.className = 'absolute top-6 left-1 right-1 bottom-1 overflow-y-auto';
            
            daySchedules.forEach((schedule, index) => {
                if (index < 2) { // Show max 2 schedules per day
                    const scheduleDiv = document.createElement('div');
                    scheduleDiv.className = `mb-1 p-1 text-xs rounded border-l-2 cursor-pointer ${getScheduleStyle(schedule)}`;
                    scheduleDiv.onclick = (e) => {
                        e.stopPropagation();
                        showScheduleModal(schedule);
                    };
                    
                    const timeText = schedule.start_time.substring(0, 5);
                    const participantsText = schedule.max_participants 
                        ? `${schedule.registrations_count}/${schedule.max_participants}`
                        : schedule.registrations_count;
                    
                    scheduleDiv.innerHTML = `
                        <div class="font-semibold">${timeText}</div>
                        <div>${participantsText} orang</div>
                    `;
                    schedulesContainer.appendChild(scheduleDiv);
                }
            });
            
            // Show "more" indicator if there are more than 2 schedules
            if (daySchedules.length > 2) {
                const moreDiv = document.createElement('div');
                moreDiv.className = 'text-xs text-gray-500 font-medium';
                moreDiv.textContent = `+${daySchedules.length - 2} lagi...`;
                schedulesContainer.appendChild(moreDiv);
            }
            
            dayDiv.appendChild(schedulesContainer);
        }
        
        // Add click handler for empty days
        dayDiv.onclick = () => {
            if (daySchedules.length === 0) {
                // Redirect to create new schedule for this date
                window.location.href = `/admin/test-schedules/create?date=${currentDateStr}`;
            }
        };
        
        calendarGrid.appendChild(dayDiv);
    }
}

function getScheduleStyle(schedule) {
    if (!schedule.is_active) {
        return 'bg-gray-100 border-gray-400 text-gray-600';
    }
    
    if (schedule.max_participants && schedule.registrations_count >= schedule.max_participants) {
        return 'bg-red-100 border-red-500 text-red-700';
    }
    
    return 'bg-green-100 border-green-500 text-green-700';
}

function showScheduleModal(schedule) {
    selectedScheduleId = schedule.id;
    
    const modal = document.getElementById('scheduleModal');
    const modalContent = document.getElementById('modalContent');
    
    const statusText = schedule.is_active ? 
        '<span class="text-green-600"><i class="fas fa-check-circle"></i> Aktif</span>' :
        '<span class="text-red-600"><i class="fas fa-times-circle"></i> Nonaktif</span>';
    
    const capacityText = schedule.max_participants ?
        `${schedule.registrations_count}/${schedule.max_participants} orang` :
        `${schedule.registrations_count} orang (tidak terbatas)`;
    
    modalContent.innerHTML = `
        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="font-medium">Waktu:</span>
                <span>${schedule.start_time.substring(0, 5)} - ${schedule.end_time.substring(0, 5)} WIB</span>
            </div>
            <div class="flex justify-between">
                <span class="font-medium">Peserta:</span>
                <span>${capacityText}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-medium">Status:</span>
                <span>${statusText}</span>
            </div>
            ${schedule.notes ? `
                <div>
                    <span class="font-medium">Catatan:</span>
                    <p class="mt-1 text-gray-600">${schedule.notes}</p>
                </div>
            ` : ''}
        </div>
    `;
    
    modal.classList.remove('hidden');
}

function closeModal() {
    document.getElementById('scheduleModal').classList.add('hidden');
    selectedScheduleId = null;
}

function editSchedule() {
    if (selectedScheduleId) {
        window.location.href = `/admin/test-schedules/${selectedScheduleId}/edit`;
    }
}

function viewDetails() {
    if (selectedScheduleId) {
        window.location.href = `/admin/test-schedules/${selectedScheduleId}`;
    }
}

function previousMonth() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
}

function nextMonth() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
}

function goToToday() {
    currentDate = new Date();
    renderCalendar();
}

// Initialize calendar
document.addEventListener('DOMContentLoaded', function() {
    renderCalendar();
});

// Close modal when clicking outside
document.getElementById('scheduleModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>
@endsection
