<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Interest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InterestSeeder extends Seeder
{
    public function run(): void
    {
        if (User::count() === 0) {
            User::factory()->create();
        }

        Interest::factory()->count(50)->create();
    }
}
