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
        DB::table('universities')->insert([
            'id'      => 6,
            'name'    => '中京大学',
        ]);
        DB::table('universities')->insert([
            'id'      => 7,
            'name'    => '同朋大学',
        ]);
        DB::table('universities')->insert([
            'id'      => 8,
            'name'    => '名古屋工業大学',
        ]);
        DB::table('universities')->insert([
            'id'      => 9,
            'name'    => '南山大学',
        ]);
        DB::table('universities')->insert([
            'id'      => 10,
            'name'    => '名古屋市立大学',
        ]);
        DB::table('universities')->insert([
            'id'      => 11,
            'name'    => '名古屋学院大学',
        ]);
        DB::table('universities')->insert([
            'id'      => 12,
            'name'    => '大同大学',
        ]);
        DB::table('universities')->insert([
            'id'      => 13,
            'name'    => '愛知東邦大学',
        ]);
        DB::table('universities')->insert([
            'id'      => 14,
            'name'    => '椙山女学園大学',
        ]);
        DB::table('universities')->insert([
            'id'      => 15,
            'name'    => '金城学院大学',
        ]);
    }
}
