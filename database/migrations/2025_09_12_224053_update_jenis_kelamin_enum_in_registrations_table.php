<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing data first (if any)
        DB::table('registrations')->where('jenis_kelamin', 'L')->update(['jenis_kelamin' => 'Laki-laki']);
        DB::table('registrations')->where('jenis_kelamin', 'P')->update(['jenis_kelamin' => 'Perempuan']);
        
        // Modify the column to accept the full text values
        DB::statement("ALTER TABLE registrations MODIFY COLUMN jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Update data back to short form
        DB::table('registrations')->where('jenis_kelamin', 'Laki-laki')->update(['jenis_kelamin' => 'L']);
        DB::table('registrations')->where('jenis_kelamin', 'Perempuan')->update(['jenis_kelamin' => 'P']);
        
        // Revert the column back to short values
        DB::statement("ALTER TABLE registrations MODIFY COLUMN jenis_kelamin ENUM('L', 'P') NOT NULL");
    }
};
