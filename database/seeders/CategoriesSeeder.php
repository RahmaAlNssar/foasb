<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            ['name' => 'الأخبار',
            'status' => 1],
            ['name' => 'أعمالنا',
            'status' => 1]
        ];
        DB::table('categories')->insert($arr);
    }
}
