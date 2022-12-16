<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::info('Seed parties');
        DB::table('parties') -> insert([
            [
                'name' => 'PartyPrueba1',
                'game_id' => 1,
                'owner' => 1
            ],
            [
                'name' => 'PartyPrueba2',
                'game_id' => 2,
                'owner' => 2
            ],
            [
                'name' => 'PartyPrueba3',
                'game_id' => 3,
                'owner' => 3
            ],
        ]);
    }
}
