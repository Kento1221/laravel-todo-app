<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = [];

        $users_id = User::all()->pluck('id');

        foreach ($users_id as $user_id) {
            for ($i = 0; $i < rand(1,5); $i++){
                $temp_rand = rand(1, 4);
                $tasks[] = [
                    'user_id' => $user_id,
                    'title' =>$this->faker->sentence(),
                    'description' => $this->faker->sentences(3, true),
                    'status_id' => $temp_rand,
                    'deadline' => $temp_rand === 4 ? now()->subDays(rand(1,6)) : null,
                ];
            }
        }

        \DB::table('tasks')->insert($tasks);
    }
}
