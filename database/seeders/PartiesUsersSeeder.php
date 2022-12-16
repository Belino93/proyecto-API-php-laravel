<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PartiesUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::info('Seed Parties_users');
        DB::table('parties_users') -> insert([
            [
                'user_id' => 1,
                'party_id' => 1,
            ],
            [
                'user_id' => 2,
                'party_id' => 1,
            ],
            [
                'user_id' => 3,
                'party_id' => 1,
            ],
            [
                'user_id' => 1,
                'party_id' => 2,
            ],
            [
                'user_id' => 3,
                'party_id' => 2,
            ],
            [
                'user_id' => 1,
                'party_id' => 3,
            ],
        ]);
    }
}
