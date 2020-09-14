<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use App\Allocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;
use File;
use App\Student;
use Auth;
use Illuminate\Support\Facades\Schema;

class ProjectController extends Controller
{

    public function __construct() {

        // Guests can only view projects
        // Stops guests creating, updating and deleting
        $this->middleware('auth')->except('index', 'show'); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Projects ordered by ID, 10 per page
        $projects = Project::orderBy('id', 'asc')->paginate(10);
        return view('projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:25',
            'description' => 'required',
            'capacity' => 'required|integer',

        ]);

        // Storing data in database
        $project = new Project;
        $project->name = $request->name;
        $project->code = $request->code;
        $project->description = $request->description;
        $project->capacity = $request->capacity;
        $project->lecturer_id = Auth::id();

        $project->save();

        Session::flash('success', 'Project created!');
        return redirect()->route('projects.show', $project->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findorFail($id);
        return view('projects.show', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate form data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required',
            'description' => 'required'
        ]);

        // Save changes to database
        $project = Project::findOrFail($id);
        $project->name = $request->input('name');
        $project->code = $request->input('code');
        $project->description = $request->input('description');

        $project->save();

        Session::flash('success', 'Project Updated!');
        return redirect()->route('projects.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allocate()
    {
        $projects = Project::all();
        $projectCount = Project::count();
        $studentCount = Student::count();
        $spaces = Project::sum('capacity');
        $users = User::orderBy('id', 'asc')->paginate(10);

        return view('projects.allocate', ['projects' => $projects, 'users' => $users, 
                    'studentCount' => $studentCount, 'projectCount' => $projectCount, 'spaces' => $spaces]);
    }

    /**
     * Run algorithm then show view with allocations
     * 
     * @return \Illuminate\Http\Response
     */
    public function algorithm() {
    
        /**
         * Files are stored in the public folder,
         * along with the runnable .jar file
         */
        $inFile = 'in.txt';
        $outFile = 'errors.txt'; // If the JAR file throws any errors, they will appear here
        Allocation::query()->delete(); // delete the existing allocations table

        /**
         * Get the students, lecturers and projects
         */
        $projects = Project::all();
        $users = User::orderBy('id', 'asc')->paginate(10);
        
        $students = Student::get();
        $studentCount = Student::count();

        $lecturers = User::where('role_id', '2')->orWhere('role_id', '1')->get();
        $lecturerCount = User::where('role_id', '2')->orWhere('role_id', '1')->count();
        
        $projCount = Project::count();

        /**
         * Create the new input file, insert number of students
         */
        file_put_contents($inFile, $studentCount);

        /**
         * Student section
         */
        foreach($students as $student) {
            // Convert preferences to project IDs
            $prefList = '';
            foreach(explode(' ', $student->preferences) as $preference) {
                $proj = Project::where('code', $preference)->first();
                $prefList = $prefList . $proj->id . ' ';
            }

            file_put_contents($inFile, "\r\n" . $student->studentNumber, FILE_APPEND);
            file_put_contents($inFile, "\r\n" . $prefList, FILE_APPEND);
        }

        /**
         * Project section
         */
        file_put_contents($inFile, "\r\n" . $projCount, FILE_APPEND);
        foreach ($projects as $project) {
            $capacityCode = $project->capacity . " " . $project->code;
            file_put_contents($inFile, "\r\n" . $capacityCode, FILE_APPEND);
        }

        /**
         * Lecturer section
         */
        Storage::append($inFile, $lecturerCount);
        file_put_contents($inFile, "\r\n" . $lecturerCount, FILE_APPEND);
        foreach($lecturers as $lecturer) {
            // Convert preferences to student IDs
            $prefList = '';
            foreach(explode(' ', $lecturer->preferences) as $preference) {
                $stud = Student::where('studentNumber', $preference)->first();
                $prefList = $prefList . $stud->id . ' ';
            }

            $totalCapacity = Project::where('lecturer_id', $lecturer->id)->sum('capacity');
            $lecturerInfo = $totalCapacity . " " . $lecturer->username;
            file_put_contents($inFile, "\r\n" . $lecturerInfo, FILE_APPEND);
            file_put_contents($inFile, "\r\n" . $prefList, FILE_APPEND);

            $projects = Project::where('lecturer_id', $lecturer->id)->get();
            foreach($projects as $project) {
                file_put_contents($inFile, "\r\n" . $project->id, FILE_APPEND);
            }
        }

        exec('java -jar SPA.jar >' .$outFile. ' 2>&1');

        /**
         * Insert the new allocations into the database
         */
        $alloc_file = file_get_contents('out.txt') or die('Allocation file could not be opened');
        
        $lines = explode("\n", $alloc_file);
        foreach($lines as $line) {

            if($line != "\r" && $line != '') {

                list($student_number, $project_code, $lecturer_email) = explode(' ', $line);
                $allocation = new Allocation();
                $allocation->student_number = $student_number;
                $allocation->project_code = $project_code;
                if($project_code == 'N/A') {
                    $allocation->lecturer_name = 'N/A';
                }
                else {
                    $user = User::where('email', $lecturer_email)->first();
                    $lecturer_name = User::find($user->id)->firstName . ' ' . User::find($user->id)->lastName;
                    $allocation->lecturer_name = $lecturer_name;
                }
                $allocation->lecturer_email = $lecturer_email;
                $allocation->save();
            }
        }

        $allocations = Allocation::orderBy('id', 'asc')->paginate(20);;
        return view('projects.allocations', ['allocations' => $allocations]);
    }
}
