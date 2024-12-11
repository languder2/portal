<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                "code"      => "admin",
                "name"      => "Администратор"
            ],
            [
                "code"      => "teacher",
                "name"      => "Преподаватель",
            ],
            [
                "code"      => "student",
                "name"      => "Студент",
            ],
            [
                "code"      => "user",
                "name"      => "Пользователь",
            ],
            [
                "code"      => "guest",
                "name"      => "Гость",
            ],
        ]);

        DB::table('role_assigned')->insert([
           'uid'        => 1,
           'rid'        => 1
        ]);


    }
}
