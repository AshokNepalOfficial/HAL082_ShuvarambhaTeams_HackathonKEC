<?php

namespace Database\Seeders;
use Database\Seeders\FileTypeSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      $this->call([
            UserSeeder::class,
            VectorstoreQualityTypeSeeder::class,
            FileTypeSeeder::class,
        ]);
    }
}
