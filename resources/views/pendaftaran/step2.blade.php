@php
    $id = request()->query('id');
    $registration = null;
    if ($id) {
        $registration = \App\Models\Registration::find($id);
    }
    $hasDraft = $registration && $registration->status === 'draft';
@endphp
<div class="bg-white p-8 rounded-xl shadow-lg">
    @if(!$hasDraft)
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <strong>Data pendaftaran belum lengkap.</strong> Silakan isi data diri terlebih dahulu.<br>
            Anda akan diarahkan ke Step 1 dalam 3 detik...
        </div>
        <script>
            setTimeout(function() {
                window.location.href = "{{ route('pendaftaran') }}?step=1";
            }, 3000);
        </script>
    @endif
    <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Penjadwalan Tes Lanjutan</h1>
    <form action="{{ route('pendaftaran.store') }}?step=finish&id={{ $id }}" method="POST" class="space-y-8" @if(!$hasDraft) style="pointer-events:none;opacity:0.5;" @endif>
        @csrf
        <div class="bg-gray-50 p-6 rounded-lg">
            @php
                use App\Models\TestSchedule;
                use Carbon\Carbon;
                
                $now = Carbon::now();
                $isWeekend = $now->isWeekend();
                
                if ($isWeekend) {
                    $nextMonday = $now->copy()->next(Carbon::MONDAY);
                    $nextFriday = $now->copy()->next(Carbon::FRIDAY);
                    
                    $testSchedules = TestSchedule::where('is_active', true)
                        ->where('date', '>=', $nextMonday->format('Y-m-d'))
                        ->where('date', '<=', $nextFriday->format('Y-m-d'))
                        ->orderBy('date')
                        ->orderBy('start_time')
                        ->get();
                    $weekInfo = 'Jadwal Tes Minggu Depan';
                    $weekNote = 'Karena hari ini adalah hari libur, jadwal yang ditampilkan adalah untuk minggu depan (' . 
                                $nextMonday->format('d M') . ' - ' . $nextFriday->format('d M Y') . ').';
                } else {
                    $endOfWeek = $now->copy()->endOfWeek(Carbon::FRIDAY);
                    
                    $testSchedules = TestSchedule::where('is_active', true)
                        ->where('date', '>=', $now->format('Y-m-d'))
                        ->where('date', '<=', $endOfWeek->format('Y-m-d'))
                        ->orderBy('date')
                        ->orderBy('start_time')
                        ->get();
                    $weekInfo = 'Jadwal Tes Minggu Ini';
                    $weekNote = 'Pilih jadwal tes yang tersedia untuk sisa minggu ini (' . 
                                $now->format('d M') . ' - ' . $endOfWeek->format('d M Y') . ').';
                }
            @endphp
            
            <div class="mb-6">
                <p class="text-lg font-semibold text-gray-800 mb-2">{{ $weekInfo }}</p>
                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">{{ $weekNote }}</p>
                            @if($isWeekend)
                                <p class="text-xs text-blue-600 mt-1">
                                    <strong>Hari ini:</strong> {{ $now->locale('id')->dayName }}, {{ $now->format('d M Y') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if($testSchedules->count() > 0)
                <p class="text-md font-medium text-gray-700 mb-4">Silakan pilih jadwal tes yang tersedia:</p>
                <div class="space-y-4">
                    @foreach($testSchedules as $schedule)
                        @php
                            $scheduleDate = Carbon::parse($schedule->date);
                            $currentTime = Carbon::now();
                            
                            // Handle start_time safely - convert to time string if it's a datetime object
                            $startTimeStr = is_object($schedule->start_time) ? $schedule->start_time->format('H:i:s') : $schedule->start_time;
                            $endTimeStr = is_object($schedule->end_time) ? $schedule->end_time->format('H:i:s') : $schedule->end_time;
                            
                            $scheduleDateTime = Carbon::parse($schedule->date)->setTimeFromTimeString($startTimeStr);

                            $hasPassed = $scheduleDateTime->isPast();

                            $currentCount = $schedule->registrations->count();
                            $maxQuota = $schedule->max_participants ?? 999;
                            $isFull = $currentCount >= $maxQuota;
                            $remainingSlots = $maxQuota - $currentCount;

                            $scheduleKey = $scheduleDate->locale('id')->dayName . ', ' . $scheduleDate->format('d M Y') . ' | ' . 
                                          Carbon::createFromTimeString($startTimeStr)->format('H.i') . ' - ' . 
                                          Carbon::createFromTimeString($endTimeStr)->format('H.i') . ' WIB';
                        @endphp
                        
                        <label class="flex items-center p-4 rounded-lg transition cursor-pointer {{ $isFull || $hasPassed ? 'bg-gray-200 text-gray-400 cursor-not-allowed' : 'bg-white hover:bg-green-50 border border-gray-200 hover:border-green-300' }}">
                            <input type="radio" 
                                   name="jadwal_abk" 
                                   value="{{ $scheduleKey }}" 
                                   class="form-radio text-green-600" 
                                   required 
                                   {{ $isFull || $hasPassed ? 'disabled' : '' }}>
                            <div class="ml-4 flex-grow">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <div class="font-semibold text-gray-800">
                                            {{ $scheduleDate->locale('id')->dayName }}, {{ $scheduleDate->format('d F Y') }}
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            {{ Carbon::createFromTimeString($startTimeStr)->format('H:i') }} - 
                                            {{ Carbon::createFromTimeString($endTimeStr)->format('H:i') }} WIB
                                        </div>
                                        @if($schedule->notes)
                                            <div class="text-xs text-gray-500 mt-1">{{ $schedule->notes }}</div>
                                        @endif
                                    </div>
                                    <div class="text-right">
                                        @if($hasPassed)
                                            <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                                Sudah Terlewat
                                            </span>
                                        @elseif($isFull)
                                            <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                                Kuota Penuh
                                            </span>
                                        @else
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                                @if($schedule->max_participants)
                                                    Sisa: {{ $remainingSlots }}/{{ $maxQuota }}
                                                @else
                                                    {{ $currentCount }} Terdaftar
                                                @endif
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @if($remainingSlots <= 3 && !$isFull && !$hasPassed && $schedule->max_participants)
                                    <p class="text-xs text-amber-600 mt-2">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        Kuota hampir penuh! Segera pilih jadwal ini.
                                    </p>
                                @endif
                            </div>
                        </label>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                        <i class="fas fa-calendar-times text-yellow-600 text-4xl mb-4"></i>
                        <h3 class="text-lg font-semibold text-yellow-800 mb-2">Belum Ada Jadwal Tersedia</h3>
                        <p class="text-yellow-700 mb-4">
                            @if($isWeekend)
                                Jadwal tes untuk minggu depan belum tersedia. Silakan coba lagi nanti atau hubungi admin.
                            @else
                                Jadwal tes untuk minggu ini belum tersedia. Silakan coba lagi nanti atau hubungi admin.
                            @endif
                        </p>
                        <a href="tel:+6281234567890" class="inline-block px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition">
                            <i class="fas fa-phone mr-2"></i>Hubungi Admin
                        </a>
                    </div>
                </div>
            @endif
        </div>
        <div class="flex justify-between pt-6">
            <a href="{{ route('pendaftaran') }}?step=1" class="px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition">
                Kembali
            </a>
            <button type="submit" class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                Selesaikan Pendaftaran
            </button>
        </div>
    </form>
</div>
