<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add a default admin user
        $email = 'admin@admin.com';
        
        // Check if exists
        $exists = DB::table('users')->where('email', $email)->exists();
        
        if (!$exists) {
            DB::table('users')->insert([
                'name' => 'Admin User',
                'email' => $email,
                'password' => Hash::make('password'),
                'role' => 'teacher',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
