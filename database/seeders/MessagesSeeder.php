<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        foreach (range(1,10) as $index) {
        DB::table('messages')->insert([
            'user_id' => User::all()->random()->id,
            'message' =>$faker->text(),
            'phone' =>User::all()->random()->phone,

        ]);
    }
    }
}
