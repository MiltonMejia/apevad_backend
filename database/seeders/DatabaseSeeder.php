<?php

namespace Database\Seeders;

use App\Models\Degree;
use App\Models\Group;
use App\Models\Teacher;
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
        // \App\Models\User::factory(10)->create();
        Teacher::factory(10)->create();
        Degree::factory(16)->create();
        Group::factory(2560)->create();
    }
}
