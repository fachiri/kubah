<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $this->createAdminUserIfNotExists();
    }

    private function createAdminUserIfNotExists(): void
    {
        $adminEmail = 'admin@gmail.com';

        if (User::where('email', $adminEmail)->exists()) {
            $this->command->info('Admin user already exists.');
            return;
        }

        try {
            $user = User::create([
                'name' => 'Admin',
                'email' => $adminEmail,
                'gender' => 'Laki-laki',
                'address' => 'Lorem ipsum dolor sit amet',
                'birth_place' => 'Gorontalo',
                'birth_date' => '2002-10-08',
                'phone' => '081234567890',
                'password' => Hash::make('Pass1234'),
                'email_verified_at' => Carbon::now()
            ]);

            Admin::create([
                'user_id' => $user->id
            ]);

            $this->command->info('Admin user created successfully.');
        } catch (\Exception $e) {
            $this->command->error('Failed to create admin user: ' . $e->getMessage());
        }
    }
}
