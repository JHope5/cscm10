<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * LECTURERS - 5 (later test 8)
         */
        $l1 = new App\User;
        $l1->username = 'a.dmin';
        $l1->password = bcrypt('pass');
        $l1->email = $l1->username . '@swansea.ac.uk';
        $l1->firstName = 'Admin';
        $l1->lastName = 'Istrator';
        $l1->role_id = '1';
        $l1->preferences = '050505 010101 020202';
        $l1->office = '102';
        $l1->save();

        $l2 = new App\User;
        $l2->username = 'a.dumbledore';
        $l2->password = bcrypt('pass');
        $l2->email = $l2->username . '@swansea.ac.uk';
        $l2->firstName = 'Albus';
        $l2->lastName = 'Dumbledore';
        $l2->role_id = '2';
        $l2->preferences = '040404 050505 010101';
        $l2->office = '307';
        $l2->save();

        $l3 = new App\User;
        $l3->username = 'i.robotnik';
        $l3->password = bcrypt('pass');
        $l3->email = $l3->username . '@swansea.ac.uk';
        $l3->firstName = 'Ivo';
        $l3->lastName = 'Robotnik';
        $l3->role_id = '2';
        $l3->preferences = '030303 040404 050505';
        $l3->office = '011';
        $l3->save();

        $l4 = new App\User;
        $l4->username = 'w.white';
        $l4->password = bcrypt('pass');
        $l4->email = $l4->username . '@swansea.ac.uk';
        $l4->firstName = 'Walter';
        $l4->lastName = 'White';
        $l4->role_id = '2';
        $l4->preferences = '020202 030303 040404';
        $l4->office = '218';
        $l4->save();

        $l5 = new App\User;
        $l5->username = 's.strange';
        $l5->password = bcrypt('pass');
        $l5->email = $l5->username . '@swansea.ac.uk';
        $l5->firstName = 'Stephen';
        $l5->lastName = 'Strange';
        $l5->role_id = '2';
        $l5->preferences = '010101 020202 030303';
        $l5->office = '309';
        $l5->save();

        /**
         * STUDENTS - 5 (later test 13)
         */
        $s1 = new App\User;
        $s1->username = '010101';
        $s1->password = bcrypt('pass');
        $s1->email = $s1->username . '@swansea.ac.uk';
        $s1->email_verified_at = now();
        $s1->role_id = '3';
        $s1->preferences = 'SS1 WW1 IR1';
        $s1->save();
        
        $s2 = new App\User;
        $s2->username = '020202';
        $s2->password = bcrypt('pass');
        $s2->email = $s2->username . '@swansea.ac.uk';
        $s2->email_verified_at = now();
        $s2->role_id = '3';
        $s2->preferences = 'WW1 IR1 AD1';
        $s2->save();
        
        $s3 = new App\User;
        $s3->username = '030303';
        $s3->password = bcrypt('pass');
        $s3->email = $s3->username . '@swansea.ac.uk';
        $s3->email_verified_at = now();
        $s3->role_id = '3';
        $s3->preferences = 'IR1 AD1 AI1';
        $s3->save();
        
        $s4 = new App\User;
        $s4->username = '040404';
        $s4->password = bcrypt('pass');
        $s4->email = $s4->username . '@swansea.ac.uk';
        $s4->email_verified_at = now();
        $s4->role_id = '3';
        $s4->preferences = 'AD1 AI1 SS1';
        $s4->save();
        
        $s5 = new App\User;
        $s5->username = '050505';
        $s5->password = bcrypt('pass');
        $s5->email = $s5->username . '@swansea.ac.uk';
        $s5->email_verified_at = now();
        $s5->role_id = '3';
        $s5->preferences = 'AI1 SS1 WW1';
        $s5->save();
    }
}
