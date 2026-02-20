<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FileTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('file_type')->insert([
            ['name' => 'PDF', 'custom_configuration' => null, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Word Document', 'custom_configuration' => null, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Excel Sheet', 'custom_configuration' => null, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Image', 'custom_configuration' => null, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}