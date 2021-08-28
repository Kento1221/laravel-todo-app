<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['status' => 'Started'],
            ['status' => 'Finished'],
            ['status' => 'Prioritized'],
            ['status' => 'Expired']
        ];

        \DB::table('task_statuses')->insert($statuses);
    }
}
