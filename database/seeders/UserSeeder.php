<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name' => 'John',
            'surname' => 'Smith',
            'email' => 'john.smith@example.com',
            'password' => bcrypt('password')
        ];

        User::create($user);
        User::factory()->count(99)->create();
    }
}
