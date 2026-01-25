<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('test_schedules', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('day_name');
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('is_active')->default(true);
            $table->text('notes')->nullable();
            $table->integer('max_participants')->nullable();
            $table->timestamps();
            
            // Index untuk performa query
            $table->index(['date', 'is_active']);
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_schedules');
    }
};
