<?php

namespace Database\Seeders;

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

        $tasks_id = Task::all()->pluck('id');

        foreach ($tasks_id as $task_id) {
            $rand = rand(0, 3);

            for ($i = 0; $i < $rand; $i++)
                $steps[] = [
                    'task_id' => $task_id,
                    'title' => $this->faker->unique()->sentence(),
                    'status_id' => rand(1,3)
                ];
        }

        \DB::table('task_steps')->insert($steps);
    }
}
