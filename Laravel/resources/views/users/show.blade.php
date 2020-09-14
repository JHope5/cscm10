<?php use App\Project; 
      use App\User;
      use App\Student; ?>

@extends('layouts.main')

@section('title', 'User Information')

@section('content')
<div class="row">
    <div class="col-md-9">
        @if($user->role_id == 1 || $user->role_id == 2)
        <h1>{{ $user->firstName . ' ' . $user->lastName }}</h1>
        @else
        <h1>{{ $user->username }}</h1>
        @endif
    </div>
    <div class="col-md-3">
        @if($user->role_id == 1 || $user->role_id == 2)
        {!! Html::linkRoute('users.edit', 'Update Preferences', array($user->id), array('class'=>'btn btn-primary btn-block')) !!}
        @endif
        @if($user->role_id == 3)
        {!! Html::linkRoute('students.edit', 'Edit', array($user->id), array('class'=>'btn btn-primary btn-block')) !!}
        @endif
    </div>
    <div class="col-md-12">
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-md-9">
        <h3>Order of Preferences</h3>
        <hr>
        @if($user->role_id == 1 || $user->role_id == 2)
        <table class="table">
                <thead>
                    <th>#</th>
                    <th>Student Number</th>
                    <th>Email</th>
                </thead>

                <tbody>
                    <?php $preferences = $user->preferences ?>
                    @foreach(explode(' ', $preferences) as $preference)
                    <?php $student = Student::where('studentNumber', $preference)->first();
                          $studID = $student->id; ?>
                        <tr>
                            <th>{{ Student::find($studID)->id }}</th>
                            <td>{{ Student::find($studID)->studentNumber }}</td>
                            <td>{{ Student::find($studID)->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
        <h3>Projects</h3>
        <table class="table">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th></th>
                </thead>

                <tbody>
                    <?php $projects = Project::get()->where('lecturer_id', $user->id); ?>
                    @foreach($projects as $project)
                        <tr>
                            <th>{{$project->id}}</th>
                            <td>{{$project->name}}</td>
                            <td>{{ $project->code}}</td>
                            <td>{{substr($project->description, 0, 50)}} <br> {{ strlen($project->content) > 50 ? Html::linkRoute('projects.show', 'Read More...', array($project->id)) : "" }}</td>
                            <td><a href="{{ route('projects.show', $project->id) }}" class="btn btn-default btn-sm">View</a>
                                @if((Auth::id() == $project->lecturer_id) || (Auth::id() == 1))
                                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-default btn-sm">Edit</a>
                                @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
            @if($user->role_id == 3)
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Project Name</th>
                    <th>Lecturer</th>
                    <th>Lecturer Email</th>
                    <th></th>
                </thead>

                <tbody>
                    <?php $preferences = $user->preferences ?>
                    @foreach(explode(' ', $preferences) as $preference)
                    <?php $proj = Project::where('code', $preference)->first();
                          $projID = $proj->id; ?>
                        <tr>
                            <th>{{ Project::find($projID)->id }}</th>
                            <td>{{ Project::find($projID)->name }}</td>
                            <td>{{ User::find(Project::find($projID)->lecturer_id)->firstName . ' ' . User::find(Project::find($projID)->lecturer_id)->lastName }}</td>
                            <td>{{ User::find(Project::find($projID)->id)->email }}</td>
                            <td><a href="{{ route('projects.show', Project::find($projID)->id) }}" class="btn btn-default btn-sm">View</a>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
    </div>
    <div class="col-md-3">
            <div class="card bg-light mb-3" style="max-width: 18rem;">
                <div class="card-header">User Information</div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-12">User ID</dt>
                        <dd class="col-sm-12">{{ $user->id }}</dd>
                    </dl>
                    <dl class="row">
                        @if($user->role_id == 1 || $user->role_id == 2)
                        <dt class="col-sm-12">Name</dt>
                        <dd class="col-sm-12">{{ $user->firstName . ' ' . $user->lastName }}</dd>
                        @endif
                        @if($user->role_id == 3)
                        <dt class="col-sm-12">Student Number</dt>
                        <dd class="col-sm-12">{{ $user->username }}</dd>
                        @endif
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-12">Email</dt>
                        <dd class="col-sm-12">{{ $user->email }}</dd>
                    </dl>
                </div>
            </div>
    </div>
</div>
@endsection