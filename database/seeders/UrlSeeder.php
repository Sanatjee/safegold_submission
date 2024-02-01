<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate and insert 100 URL records
        for ($i = 1; $i <= 1000; $i++) {
            DB::table('urls')->insert([
                'user_id' => 5,
                'original_url' => 'https://example.com/',
                'short_url' => 'https://example.com/',
                'status' => 'active',
            ]);
        }
    }
}
