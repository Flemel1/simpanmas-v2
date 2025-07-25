<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Burhan',
            'email' => 'burhan@gmail.com',
        ]);

        Admin::factory()->create([
            'name' => $user->name,
            'user_id' => $user->id
        ]);
    }
}
