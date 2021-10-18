<?php

namespace Database\Seeders;

use App\Models\TaskList;
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

        $user_ids = User::all()->pluck('id');

        foreach ($user_ids as $user_id) {
            $task_list_ids = TaskList::where('user_id', $user_id)->get()->pluck('id')->toArray();
            for ($i = 0; $i < rand(1,5); $i++){
                $tasks[] = [
                    'user_id' => $user_id,
                    'task_list_id' => $task_list_ids[array_rand($task_list_ids)],
                    'title' =>$this->faker->sentence(),
                    'status_id' => rand(1, 4),
                ];
            }
        }

        \DB::table('tasks')->insert($tasks);
    }
}
