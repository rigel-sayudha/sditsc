<?php
// Laravel Artisan Command untuk membuat admin user
// File: app/Console/Commands/CreateAdminUser.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create {--name=Administrator} {--email=admin@example.com} {--password=password}';
    
    protected $description = 'Create an admin user for the application';

    public function handle()
    {
        $name = $this->option('name');
        $email = $this->option('email');
        $password = $this->option('password');

        // Check if user exists
        if (User::where('email', $email)->exists()) {
            $this->error("User with email {$email} already exists!");
            
            if ($this->confirm('Do you want to update the password?')) {
                User::where('email', $email)->update([
                    'password' => Hash::make($password)
                ]);
                $this->info("✅ Password updated successfully!");
                $this->info("Email: {$email}");
                $this->info("Password: {$password}");
            }
            return;
        }

        // Create user
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->info("✅ Admin user created successfully!");
        $this->info("Name: {$name}");
        $this->info("Email: {$email}");
        $this->info("Password: {$password}");
    }
}
?>