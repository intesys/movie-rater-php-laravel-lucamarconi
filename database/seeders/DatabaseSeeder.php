<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // utenza filament
        if (app()->environment('local')) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => env('FILAMENT_EMAIL', 'admin@admin.it'),
                'password' => Hash::make(env('FILAMENT_PASSWORD', 'admin')),
            ]);
        }

        $this->call([
            MovieSeeder::class,
        ]);
    }

    // php artisan migrate --seed
}
