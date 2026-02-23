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
        $users = User::all();

        if ($users->isEmpty()) {
            $user = User::factory()->create();
            $users = collect([$user]);
        }

        Interest::factory()->count(50)->create();
    }
}
