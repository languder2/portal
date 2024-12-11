<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use function Laravel\Prompts\password;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'email'         => 'languder1985@ya.ru',
            'login'         => 'admin',
            'password'      => bcrypt('Work-2024'),
            'firstname'     => 'Сергей',
            'middlename'    => 'Викторович',
            'lastname'      => 'Султан'
        ]);

    }
}
