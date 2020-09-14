<?php use App\User;
      use App\Project; ?>

@extends('layouts.main')

@section('title', 'Projects')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1>All Projects</h1>
        </div>
        <div class="col-md-3">
        <a href="{{ route('projects.create') }}" class="btn btn-lg btn-block btn-primary">Create New Project</a>
        </div>
    </div>
    <div class="col-md-12">
        <hr>
    </div>
    <div class="pagination">
        {!! $projects->links(); !!}
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Project Name</th>
                    <th>Project Code</th>
                    <th>Offered By</th>
                    <th>Description</th>
                    <th></th>
                </thead>

                <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <th>{{ $project->id }}</th>
                            <td>{{ $project->name }} </td>
                            <td>{{ $project->code }}</td>
                            <td><a href="{{ route('users.show', $project->lecturer_id) }}">{{ User::find($project->lecturer_id)->firstName . ' ' . User::find($project->lecturer_id)->lastName }}</a></td>
                            <td>{{substr($project->description, 0, 50)}} <br> {{ strlen($project->description) > 50 ? Html::linkRoute('projects.show', 'Read More...', array($project->id)) : "" }}</td>
                            <td><a href="{{ route('projects.show', $project->id) }}" class="btn btn-default btn-sm">View</a>
                                @if((Auth::id() == $project->lecturer_id) || (Auth::id() == 1))
                                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-default btn-sm">Edit</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {!! $projects->links(); !!}
            </div>
        </div>
    </div>

@endsection