<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestSchedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TestScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentDate = Carbon::now();
        $isWeekend = $currentDate->isWeekend();
        
        // Jika hari Sabtu atau Minggu, tampilkan jadwal minggu depan
        if ($isWeekend) {
            $schedules = TestSchedule::nextWeek()
                ->orderBy('date')
                ->orderBy('start_time')
                ->get();
            $viewTitle = 'Jadwal Tes Minggu Depan';
        } else {
            $schedules = TestSchedule::thisWeek()
                ->orderBy('date')
                ->orderBy('start_time')
                ->get();
            $viewTitle = 'Jadwal Tes Minggu Ini';
        }

        // Group schedules by date
        $groupedSchedules = $schedules->groupBy(function($schedule) {
            return $schedule->date->format('Y-m-d');
        });

        return view('admin.test-schedules.index', compact('groupedSchedules', 'viewTitle', 'isWeekend'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.test-schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'max_participants' => 'nullable|integer|min:1',
            'notes' => 'nullable|string|max:500'
        ]);

        $date = Carbon::parse($request->date);
        $dayName = $date->format('l'); // Nama hari dalam bahasa Inggris
        
        // Translate to Indonesian
        $dayNames = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa', 
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        ];

        TestSchedule::create([
            'date' => $request->date,
            'day_name' => $dayNames[$dayName],
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'is_active' => $request->has('is_active'),
            'max_participants' => $request->max_participants,
            'notes' => $request->notes
        ]);

        return redirect()->route('admin.test-schedules.index')
            ->with('success', 'Jadwal tes berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TestSchedule $testSchedule)
    {
        $testSchedule->load('registrations');
        return view('admin.test-schedules.show', compact('testSchedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TestSchedule $testSchedule)
    {
        return view('admin.test-schedules.edit', compact('testSchedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TestSchedule $testSchedule)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'max_participants' => 'nullable|integer|min:1',
            'notes' => 'nullable|string|max:500'
        ]);

        $date = Carbon::parse($request->date);
        $dayName = $date->format('l');
        
        $dayNames = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu', 
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        ];

        $testSchedule->update([
            'date' => $request->date,
            'day_name' => $dayNames[$dayName],
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'is_active' => $request->has('is_active'),
            'max_participants' => $request->max_participants,
            'notes' => $request->notes
        ]);

        return redirect()->route('admin.test-schedules.index')
            ->with('success', 'Jadwal tes berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TestSchedule $testSchedule)
    {
        // Cek apakah ada pendaftar
        if ($testSchedule->registrations()->count() > 0) {
            return redirect()->route('admin.test-schedules.index')
                ->with('error', 'Tidak dapat menghapus jadwal yang sudah memiliki pendaftar.');
        }

        $testSchedule->delete();

        return redirect()->route('admin.test-schedules.index')
            ->with('success', 'Jadwal tes berhasil dihapus.');
    }

    /**
     * Toggle active status of schedule
     */
    public function toggleStatus(TestSchedule $testSchedule)
    {
        $testSchedule->update([
            'is_active' => !$testSchedule->is_active
        ]);

        $status = $testSchedule->is_active ? 'diaktifkan' : 'dinonaktifkan';
        
        return redirect()->back()
            ->with('success', "Jadwal tes berhasil {$status}.");
    }

    /**
     * Get calendar view
     */
    public function calendar()
    {
        $testSchedules = TestSchedule::with('registrations')
            ->where('date', '>=', Carbon::now()->startOfMonth())
            ->where('date', '<=', Carbon::now()->addMonth()->endOfMonth())
            ->get();

        return view('admin.test-schedules.calendar', compact('testSchedules'));
    }
}
