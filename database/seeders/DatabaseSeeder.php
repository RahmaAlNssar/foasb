<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();



        $this->call(AdminSeeder::class);
        $this->call(TreesSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(SubcatsSeeder::class);
        $this->call(PostsSeeder::class);
        $this->call(ImagesSeeder::class);
        $this->call(OrdersSeeder::class);
        $this->call(MessagesSeeder::class);
    }
}
