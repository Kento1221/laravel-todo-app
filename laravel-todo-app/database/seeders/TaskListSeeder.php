<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskListSeeder extends Seeder
{
    private \Faker\Generator $faker;

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
        $lists = [];
        $user_ids = User::all()->pluck('id');
        $status_ids = Status::all()->pluck('id')->toArray();

        foreach ($user_ids as $user_id) {
            for ($i = 0; $i < rand(1, 4); $i++) {
                $status_id = $status_ids[array_rand($status_ids)];
                $lists[] = [
                    'title' => $this->faker->sentence(),
                    'description' => implode(' ', $this->faker->sentences(2)),
                    'user_id' => $user_id,
                    'status_id' => $status_id,
                    'deadline' => $status_id === Status::EXPIRED ? now()->subDays(rand(1, 6)) : null
                ];
            }
        }

        \DB::table('task_lists')->insert($lists);
    }
}
