<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VectorstoreQualityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('vectorstore_quality')->insert([
            ['name' => 'High', 'value' => 'high', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Medium', 'value' => 'medium', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Low', 'value' => 'low', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}