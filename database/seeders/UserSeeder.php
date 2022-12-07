<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::info('Seed users');
        DB::table('users') -> insert([
            [
                'userName' => 'Belinomp93',
                'email' => 'abel@abel.com',
                'password' => 'pass0000',
            ],
            [
                'userName' => 'Maretaaaa',
                'email' => 'mara@mara.com',
                'password' => 'pass1111',
            ],
            [
                'userName' => 'Hectooooor',
                'email' => 'hector@hector.com',
                'password' => 'pass2222',
            ],
            
        ]);
    }
}
