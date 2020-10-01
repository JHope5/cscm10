<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * PROJECTS - 5 (later test 13)
         */
        $p1 = new App\Project;
        $p1->name = 'Student Project Allocation Problem';
        $p1->code = 'AI1';
        $p1->lecturer_id = '1';
        $p1->description = 'The stable marriage problem, matching students to projects.';
        $p1->capacity = '1';
        $p1->save();

        $p2 = new App\Project;
        $p2->name = 'Wand Gestures';
        $p2->code = 'AD1';
        $p2->lecturer_id = '2';
        $p2->description = 'Create a system to identify different gestures for a wand for spells.';
        $p2->capacity = '1';
        $p2->save();

        $p3 = new App\Project;
        $p3->name = 'Sonic the Hedgehog';
        $p3->code = 'IR1';
        $p3->lecturer_id = '3';
        $p3->description = 'Using technologies you are comfortable with, develop a platform game.';
        $p3->capacity = '1';
        $p3->save();

        $p4 = new App\Project;
        $p4->name = 'Chemistry in Computer Science';
        $p4->code = 'WW1';
        $p4->lecturer_id = '4';
        $p4->description = 'Using an arduino, create a system that can automatically cook chemical substances based on user input.';
        $p4->capacity = '1';
        $p4->save();

        $p5 = new App\Project;
        $p5->name = 'Multiverse of Madness';
        $p5->code = 'SS1';
        $p5->lecturer_id = '5';
        $p5->description = 'Design and develop a system that allows the use of travel between alternate universes.';
        $p5->capacity = '1';
        $p5->save();

        /*/ 6
        $p6 = new App\Project;
        $p6->name = "Rock Band Simulator";
        $p6->code = "DF1";
        $p6->lecturer_id = "6";
        $p6->choice1 = "030303";
        $p6->save();

        // 7
        $p7 = new App\Project;
        $p7->name = "Defence Against the Dark Arts with Python";
        $p7->code = "PSS1";
        $p7->lecturer_id = "7";
        $p7->choice1 = "010101";
        $p7->choice2 = "111111";
        $p7->save();

        // 8
        $p8 = new App\Project;
        $p8->name = "Telekenetic Artificial Intelligence";
        $p8->code = "JH1";
        $p8->lecturer_id = "8";
        $p8->choice1 = "050505";
        $p8->choice2 = "070707";
        $p8->choice3 = "040404";
        $p8->save();

        // 9
        $p9 = new App\Project;
        $p9->name = "Machine Learning Games";
        $p9->code = "AI2";
        $p9->lecturer_id = "1";
        $p9->choice1 = "131313";
        $p9->choice2 = "121212";
        $p9->save();

        // 10
        $p10 = new App\Project;
        $p10->name = "Another project";
        $p10->code = "JH2";
        $p10->lecturer_id = "8";
        $p10->choice1 = "020202";
        $p10->choice2 = "101010";
        $p10->choice3 = "121212";
        $p10->save();

        // 11
        $p11 = new App\Project;
        $p11->name = "Some other project";
        $p11->code = "DSS2";
        $p11->lecturer_id = "3";
        $p11->choice1 = "030303";
        $p11->save();

        // 12
        $p12 = new App\Project;
        $p12->name = "A series of strange events";
        $p12->code = "JH3";
        $p12->lecturer_id = "8";
        $p12->choice1 = "010101";
        $p12->choice2 = "131313";
        $p12->choice3 = "060606";
        $p12->save();

        // 13
        $p13 = new App\Project;
        $p13->name = "Unlucky number";
        $p13->code = "VF2";
        $p13->lecturer_id = "5";
        $p13->choice1 = "060606";
        $p13->save();
*/
        //$students = App\Student::all()->pluck('studentNumber');
        //factory(App\Project::class, 11)->create();
    }
}
