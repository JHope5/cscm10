<?php use App\User;
      use App\Project; ?>

@extends('layouts.main')

@section('title', 'Allocation')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1>Students</h1>
        </div>
        <div class="col-md-3">
        <a href="{{ route('algorithm') }}" class="btn btn-lg btn-block btn-primary">Run Algorithm</a>
        </div>
    </div>
    <div class="col-md-12">
    <p>Students: {{ $studentCount }}, Projects: {{ $projectCount }}, Project spaces: {{ $spaces }}</p>
        <hr>
    </div>
    <div class="pagination">
        {!! $users->links(); !!}
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Student Number</th>
                    <th>Contact</th>
                    <th>Choices</th>
                    <th></th>
                </thead>

                <tbody>
                    @foreach($users as $user)
                        @if(User::find($user->id)->role_id == 3)
                        <tr>
                            <th>{{ $user->id }}</th>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->preferences }}</td>
                            <td><a href="{{ route('users.show', $user->id) }}" class="btn btn-default btn-sm">View</a>
                                @if(Auth::id() == 1)
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-default btn-sm">Edit</a>
                                @endif
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {!! $users->links(); !!}
            </div>
        </div>
    </div>

@endsection