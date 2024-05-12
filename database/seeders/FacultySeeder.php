<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('faculties')->insert([
            ['university_id' => 1, 'name' => '経営学部'],
            ['university_id' => 1, 'name' => '経済学部'],
            ['university_id' => 1, 'name' => '法学部'],
            ['university_id' => 1, 'name' => '現代中国学部'],
            ['university_id' => 1, 'name' => '国際コミニュケーション学部'],
            ['university_id' => 1, 'name' => '文学部'],
            ['university_id' => 1, 'name' => '地域政策学部'],
            ['university_id' => 1, 'name' => '短期大学部'],
            ['university_id' => 2, 'name' => '経営学部'],
            ['university_id' => 2, 'name' => '経済学部'],
            ['university_id' => 2, 'name' => '理工学部'],
            ['university_id' => 2, 'name' => '外国語学部'],
            ['university_id' => 2, 'name' => '都市情報学部'],
            ['university_id' => 3, 'name' => '経営学部'],
            ['university_id' => 3, 'name' => '経済学部'],
            ['university_id' => 3, 'name' => '法学部'],
            ['university_id' => 3, 'name' => '文学部'],
            ['university_id' => 3, 'name' => '心理学部'],
            ['university_id' => 3, 'name' => '総合政策学部'],
            ['university_id' => 3, 'name' => '薬学部'],
            ['university_id' => 4, 'name' => '理学部'],
            ['university_id' => 4, 'name' => '経済学部'],
            ['university_id' => 4, 'name' => '法学部'],
            ['university_id' => 4, 'name' => '文学部'],
            ['university_id' => 4, 'name' => '医学部'],
            ['university_id' => 4, 'name' => '農学部'],
            ['university_id' => 4, 'name' => '工学部'],
            ['university_id' => 5, 'name' => '経営部'],
            ['university_id' => 5, 'name' => '情報科学部'],
            ['university_id' => 5, 'name' => '工学部'],
        ]);
    }
}
