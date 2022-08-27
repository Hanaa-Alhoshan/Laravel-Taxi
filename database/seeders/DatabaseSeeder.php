<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

       \App\Models\User::factory()->create([
            'name' => 'hanaa alhoshan',
            'email' => 'hanaahoshan@gmail.com',
            'password' => bcrypt('hanaa'),
            'phone_number'=>'0943646509',
            'isAdmin'=>'1',
        ]);
      
        \App\Models\User::factory()->create([
            'name' => 'kenana alghazali',
            'email' => 'kenanaghazali@gmail.com',
            'password' => bcrypt('kenan'),
            'phone_number'=>'0992801245',
            'isAdmin'=>'1',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'mooaz alsobh',
            'email' => 'mooazsobh@gmail.com',
            'password' => bcrypt('mooaz'),
            'phone_number'=>'0938057607',
            'isAdmin'=>'1',
        ]);
    }
}
