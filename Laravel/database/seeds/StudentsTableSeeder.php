<?php

use Illuminate\Database\Seeder;
use App\User;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $students = User::where('role_id', '3')->get();
        foreach($students as $student) {
            $s = new App\Student;
            $s->studentNumber = $student->username;
            $s->email = $student->email;
            $s->preferences = $student->preferences;
            $s->save();
        }
    }
}
