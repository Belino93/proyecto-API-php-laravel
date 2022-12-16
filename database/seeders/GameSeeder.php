<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::info('Seed games');
        DB::table('games') -> insert([
            [
                'title' => 'Call of Duty',
                'genre' => 'Action',
                'developed' => 'Activision',
                'user_id' => 1
            ],
            [
                'title' => 'Fifa 23',
                'genre' => 'Sports',
                'developed' => 'EA',
                'user_id' => 1
            ],
            [
                'title' => 'World of Warcraft',
                'genre' => 'MMO',
                'developed' => 'Activision',
                'user_id' => 1
            ],
            [
                'title' => 'League of Legends',
                'genre' => 'MOBA',
                'developed' => 'Riot Games',
                'user_id' => 1
            ],
            [
                'title' => 'NBA 2K23',
                'genre' => 'Sports',
                'developed' => '2K Games',
                'user_id' => 1
            ],
            [
                'title' => 'Forza horizon 5',
                'genre' => 'Racing',
                'developed' => 'Xbox Game Studios',
                'user_id' => 1
            ],
        ]);
    }
}
