<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $users = User::all()->pluck('id')->toArray();

        for ($i = 1;$i < 20;$i++) {
            $sentence = $faker->sentence(10);
            DB::table('posts')->insert([
                'title' => $sentence,
                'user_id' => $faker->randomElement($users),
                'slug' => implode('-', explode(' ', strtolower(str_replace('.', '', $sentence)))),
                'content' => $faker->text()
            ]);
        }
    }
}
