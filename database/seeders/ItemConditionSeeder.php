<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('item_conditions')->insert([
            'id'      => 1,
            'name'    => '新品、未使用',
            'sort_no' => 1,
          ]);
        DB::table('item_conditions')->insert([
            'id'      => 2,
            'name'    => '未使用に近い',
            'sort_no' => 2,
          ]);
        DB::table('item_conditions')->insert([
            'id'      => 3,
            'name'    => '目立った傷や汚れなし',
            'sort_no' => 3,
          ]);
        DB::table('item_conditions')->insert([
            'id'      => 4,
            'name'    => 'やや傷や汚れあり',
            'sort_no' => 4,
          ]);
        DB::table('item_conditions')->insert([
            'id'      => 5,
            'name'    => '傷や汚れあり',
            'sort_no' => 5,
          ]);
        DB::table('item_conditions')->insert([
            'id'      => 6,
            'name'    => '全体的に状態が悪い',
            'sort_no' => 6,
          ]);
    }
}
