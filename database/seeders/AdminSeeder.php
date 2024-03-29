<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insertOrIgnore([
            [
                'email'             =>  'vanty@gmail.com',
                'password'          =>  bcrypt('123456'),
                'username'          =>  'vanty120',
                'ho_ten'            =>  'Nguyễn Văn Tỵ',
                'sdt'               =>  '0366508231',
                'is_master'         =>  '1',
            ],
        ]);
    }
}
