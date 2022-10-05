<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::truncate();
        \App\Models\User::factory(10)->create();
        \App\Models\User::factory()->create([
            'username' => 'admin',
            'name' => 'admin',
            'password' => bcrypt('password'),
            'email' => 'admin@admin.com',
        ]);
    }
}
