<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['id' => Status::STARTED,'status' => 'Started'],
            ['id' => Status::PRIORITIZED,'status' => 'Prioritized'],
            ['id' => Status::FINISHED,'status' => 'Finished'],
            ['id' => Status::EXPIRED,'status' => 'Expired'],
            ['id' => Status::DELETED,'status' => 'Deleted']
        ];

        \DB::table('statuses')->insert($statuses);
    }
}
