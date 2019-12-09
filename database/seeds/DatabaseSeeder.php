<?php

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
        factory('App\Model\User', 50)->create();
        factory('App\Model\Employee', 50)->create();
        // factory('App\Model\Attendance', 50)->create();
        // factory('App\Model\AttendanceMonth', 50)->create();
    }
}
