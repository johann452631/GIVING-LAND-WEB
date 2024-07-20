<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ContactInformation;
use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        
        $this->call([
            UserSeeder::class,
            ProfileSeeder::class,
            ContactInformationSeeder::class,
            PostSeeder::class,
            FavoriteSeeder::class,
            ImageSeeder::class
        ]);
    }
}
