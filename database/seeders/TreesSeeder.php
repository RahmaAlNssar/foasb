<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TreesSeeder extends Seeder
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
        DB::table('trees')->insert([
            'user_id' => User::all()->random()->id,
            'lon' =>$faker->unique()->randomDigit,
            'lat' => $faker->unique()->randomDigit

        ]);
    }
    }
}
