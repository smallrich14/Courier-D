<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
        	'name' => 'available'
        ]);

        DB::table('statuses')->insert([
        	'name' => 'unavailable'
        ]);

        DB::table('statuses')->insert([
            'name' => 'pending'
        ]);

        DB::table('statuses')->insert([
            'name' => 'approved'
        ]);

        DB::table('statuses')->insert([
            'name' => 'reject'
        ]);
    }
}
