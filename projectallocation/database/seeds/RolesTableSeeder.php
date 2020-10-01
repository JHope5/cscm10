<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $r1 = new App\Role;
        $r1->name = 'Administrator';
        $r1->save();

        $r2 = new App\Role;
        $r2->name = 'Lecturer';
        $r2->save();

        $r3 = new App\Role;
        $r3->name = 'Student';
        $r3->save();
    }
}
