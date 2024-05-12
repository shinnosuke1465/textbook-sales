<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('universities')->insert([
            'id'      => 1,
            'name'    => '愛知大学',
          ]);
        DB::table('universities')->insert([
            'id'      => 2,
            'name'    => '名城大学',
          ]);
        DB::table('universities')->insert([
            'id'      => 3,
            'name'    => '愛知学院大学',
          ]);
        DB::table('universities')->insert([
            'id'      => 4,
            'name'    => '名古屋大学',
          ]);
        DB::table('universities')->insert([
            'id'      => 5,
            'name'    => '愛知工業大学',
          ]);
    }
}
