<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::info('Seed Messages');
        DB::table('messages')-> insert([
            [
                'party_id' => 1,
                'user_id' => 1,
                'content' => 'Hola, soy 1'
            ],
            [
                'party_id' => 1,
                'user_id' => 2,
                'content' => 'Hola, soy 2'
            ],
            [
                'party_id' => 1,
                'user_id' => 3,
                'content' => 'Hola, soy 3'
            ],
            [
                'party_id' => 2,
                'user_id' => 1,
                'content' => 'Hola, soy 1'
            ],
            [
                'party_id' => 2,
                'user_id' => 3,
                'content' => 'Hola, soy 3'
            ],
            [
                'party_id' => 1,
                'user_id' => 1,
                'content' => 'Hola, soy 1 otra vez'
            ],
            [
                'party_id' => 3,
                'user_id' => 3,
                'content' => 'Yo soy 3'
            ],
            [
                'party_id' => 1,
                'user_id' => 1,
                'content' => 'Yo soy 1'
            ],
        ]);
    }
}
