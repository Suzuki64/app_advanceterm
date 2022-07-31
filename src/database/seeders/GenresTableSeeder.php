<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            'id' => '1',
            'name_genre' => '寿司',
        ]);

        DB::table('genres')->insert([
            'id' => '2',
            'name_genre' => '焼肉',
        ]);

        DB::table('genres')->insert([
            'id' => '3',
            'name_genre' => '居酒屋',
        ]);

        DB::table('genres')->insert([
            'id' => '4',
            'name_genre' => 'イタリアン',
        ]);

        DB::table('genres')->insert([
            'id' => '5',
            'name_genre' => 'ラーメン',
        ]);
    }
}
