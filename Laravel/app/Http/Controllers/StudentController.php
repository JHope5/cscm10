<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Student;
use Session;

class StudentController extends Controller
{
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
            'preferences' => 'required|max:255',
        ]);

        // Save changes to database
        $user = User::findOrFail($id);
        $user->preferences = $request->input('preferences');
        $user->save();

        $student = Student::where('studentNumber', $user->username)->first();
        $student->preferences = $request->input('preferences');
        $student->save();

        Session::flash('success', 'Preferences Updated!');
        return redirect()->route('users.show', $user->id);
    }

    public function edit($id) {
        $student = User::findorFail($id);
        return view('students.edit', ['student' => $student]);
    }
}
