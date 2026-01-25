<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TestSchedule;
use Carbon\Carbon;

class TestScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data (use query builder to avoid foreign key constraint issues)
        TestSchedule::query()->delete();

        $currentDate = Carbon::now();
        $schedules = [];

        // Generate schedules for this week and next week
        for ($week = 0; $week < 2; $week++) {
            $startOfWeek = $currentDate->copy()->addWeeks($week)->startOfWeek(Carbon::MONDAY);
            
            // Monday to Friday schedules
            for ($day = 0; $day < 5; $day++) {
                $date = $startOfWeek->copy()->addDays($day);
                $dayNames = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
                
                // Morning session
                $schedules[] = [
                    'date' => $date->format('Y-m-d'),
                    'day_name' => $dayNames[$day],
                    'start_time' => '08:00:00',
                    'end_time' => '10:00:00',
                    'is_active' => $day !== 3 || $week !== 0, // Thursday this week is inactive (example holiday)
                    'max_participants' => 20,
                    'notes' => $day === 3 && $week === 0 ? 'Hari libur nasional' : 'Sesi pagi',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Afternoon session (only Mon, Wed, Fri)
                if (in_array($day, [0, 2, 4])) {
                    $schedules[] = [
                        'date' => $date->format('Y-m-d'),
                        'day_name' => $dayNames[$day],
                        'start_time' => '13:00:00',
                        'end_time' => '15:00:00',
                        'is_active' => true,
                        'max_participants' => 15,
                        'notes' => 'Sesi siang',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        // Insert all schedules
        TestSchedule::insert($schedules);
        
        $this->command->info('Test schedules seeded successfully!');
        $this->command->info('Created ' . count($schedules) . ' test schedules');
        $this->command->info('Note: Thursday this week is marked as inactive (holiday example)');
    }
}
