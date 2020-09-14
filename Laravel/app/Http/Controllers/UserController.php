<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Project;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', ['users'=> $users]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findorFail($id);
        //$preferences = explode(' ', User::where('id', $id)->get('choices'));
        //echo $preferences;
        return view('users.show', ['user' => $user ]); 
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
            'preferences' => 'required|max:255',
        ]);

        // Save changes to database
        $user = User::findOrFail($id);
        $user->preferences = $request->input('preferences');
        $user->save();

        Session::flash('success', 'Preferences Updated!');
        return redirect()->route('users.show', $user->id);
    }

    public function edit($id) {
        $user = User::findorFail($id);
        return view('users.edit', ['user' => $user]);
    }
}
