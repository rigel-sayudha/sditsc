<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestSchedule;
use Carbon\Carbon;

class TestSchedulePublicController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::now();
        $isWeekend = $currentDate->isWeekend();
        
        // Jika hari Sabtu atau Minggu, tampilkan jadwal minggu depan
        if ($isWeekend) {
            $schedules = TestSchedule::nextWeek()
                ->active()
                ->orderBy('date')
                ->orderBy('start_time')
                ->get();
            $viewTitle = 'Jadwal Tes Minggu Depan';
            $weekInfo = 'Hari ini adalah akhir pekan. Berikut adalah jadwal tes untuk minggu depan.';
        } else {
            $schedules = TestSchedule::thisWeek()
                ->active()
                ->where('date', '>=', $currentDate->format('Y-m-d'))
                ->orderBy('date')
                ->orderBy('start_time')
                ->get();
            $viewTitle = 'Jadwal Tes Minggu Ini';
            $weekInfo = 'Berikut adalah jadwal tes yang tersedia untuk minggu ini.';
        }

        // Group schedules by date
        $groupedSchedules = $schedules->groupBy(function($schedule) {
            return $schedule->date->format('Y-m-d');
        });

        return view('test-schedules.index', compact('groupedSchedules', 'viewTitle', 'weekInfo', 'isWeekend'));
    }

    public function getAvailableSchedules()
    {
        $schedules = TestSchedule::getAvailableSchedules();
        
        return response()->json([
            'schedules' => $schedules->map(function($schedule) {
                return [
                    'id' => $schedule->id,
                    'date' => $schedule->date->format('Y-m-d'),
                    'day_name' => $schedule->day_name,
                    'start_time' => $schedule->start_time->format('H:i'),
                    'end_time' => $schedule->end_time->format('H:i'),
                    'available_slots' => $schedule->max_participants ? 
                        $schedule->max_participants - $schedule->registrations->count() : 
                        null,
                    'notes' => $schedule->notes
                ];
            })
        ]);
    }
}
