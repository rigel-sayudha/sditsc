<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TestSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'day_name',
        'start_time',
        'end_time',
        'is_active',
        'notes',
        'max_participants'
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime:H:i:s',
        'end_time' => 'datetime:H:i:s',
        'is_active' => 'boolean'
    ];

    // Scope untuk mendapatkan jadwal aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk mendapatkan jadwal hari ini
    public function scopeToday($query)
    {
        return $query->whereDate('date', Carbon::today());
    }

    // Scope untuk mendapatkan jadwal minggu ini
    public function scopeThisWeek($query)
    {
        return $query->whereBetween('date', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);
    }

    // Scope untuk mendapatkan jadwal minggu depan
    public function scopeNextWeek($query)
    {
        return $query->whereBetween('date', [
            Carbon::now()->addWeek()->startOfWeek(),
            Carbon::now()->addWeek()->endOfWeek()
        ]);
    }

    // Method untuk cek apakah jadwal sudah penuh
    public function isFull()
    {
        if (!$this->max_participants) {
            return false;
        }
        
        return $this->registrations()->count() >= $this->max_participants;
    }

    // Method untuk mendapatkan sisa slot yang tersedia
    public function availableSlots()
    {
        if (!$this->max_participants) {
            return null; // Unlimited slots
        }
        
        $currentCount = $this->registrations()->count();
        return max(0, $this->max_participants - $currentCount);
    }

    // Method untuk mendapatkan persentase kapasitas yang terisi
    public function capacityPercentage()
    {
        if (!$this->max_participants) {
            return 0;
        }
        
        $currentCount = $this->registrations()->count();
        return round(($currentCount / $this->max_participants) * 100);
    }

    // Method untuk mendapatkan status jadwal
    public function getStatusAttribute()
    {
        if (!$this->is_active) {
            return 'inactive';
        }
        
        if ($this->isFull()) {
            return 'full';
        }
        
        $capacityPercentage = $this->capacityPercentage();
        if ($capacityPercentage >= 80) {
            return 'almost_full';
        }
        
        return 'available';
    }

    // Method untuk mendapatkan badge status
    public function getStatusBadgeAttribute()
    {
        switch ($this->status) {
            case 'inactive':
                return '<span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">Nonaktif</span>';
            case 'full':
                return '<span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">Penuh</span>';
            case 'almost_full':
                return '<span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">Hampir Penuh</span>';
            case 'available':
                return '<span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Tersedia</span>';
            default:
                return '<span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">Unknown</span>';
        }
    }

    // Method untuk cek apakah jadwal sudah lewat
    public function isPast()
    {
        $scheduleDateTime = Carbon::parse($this->date->format('Y-m-d') . ' ' . $this->end_time->format('H:i:s'));
        return $scheduleDateTime->isPast();
    }

    // Method untuk mendapatkan durasi tes dalam menit
    public function getDurationInMinutes()
    {
        $startTime = Carbon::parse($this->start_time);
        $endTime = Carbon::parse($this->end_time);
        return $startTime->diffInMinutes($endTime);
    }

    // Relasi ke registrations (peserta yang mendaftar)
    public function registrations()
    {
        return $this->hasMany(Registration::class, 'test_schedule_id');
    }

    // Method untuk mendapatkan jadwal yang tersedia (aktif dan belum penuh)
    public static function getAvailableSchedules()
    {
        return static::active()
            ->where('date', '>=', Carbon::today())
            ->get()
            ->filter(function ($schedule) {
                return !$schedule->isFull();
            });
    }
}
