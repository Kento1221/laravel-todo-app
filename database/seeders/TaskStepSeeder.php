<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\Task;
use Faker\Factory;
use Illuminate\Database\Seeder;

class TaskStepSeeder extends Seeder
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function run()
    {
        $steps = [];

        $task_ids = Task::all()->pluck('id');
        $status_ids = Status::all()->pluck('id')->toArray();

        foreach ($task_ids as $task_id) {
            for ($i = 0; $i < rand(0, 3); $i++)
                $steps[] = [
                    'task_id' => $task_id,
                    'title' => $this->faker->unique()->sentence(),
                    'status_id' => $status_ids[array_rand($status_ids)]
                ];
        }

        \DB::table('task_steps')->insert($steps);
    }
}
