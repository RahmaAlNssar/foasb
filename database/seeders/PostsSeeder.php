<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Subcat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        foreach (range(1,5) as $index) {
        DB::table('posts')->insert([
            'title' => $faker->words(rand(5, 10), true),
            'body' => $faker->text(50),
            'status' => rand(0,1),
            'subcat_id'=>Subcat::all()->random()->id,

        ]);
    }
    }
}
