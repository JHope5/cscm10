<?php use App\User;
      use App\Project; ?>

@extends('layouts.main')

@section('title', 'Users')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>All Users</h1>
        </div>
    </div>
    <div class="col-md-12">
        <hr>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th></th>
                </thead>

                <tbody>
                    @foreach($users as $user)
                        @if ((User::find($user->id)->role_id == 1) || (User::find($user->id)->role_id == 2))
                        <tr>
                            <th>{{ $user->id }}</th>
                            <th>{{ $user->name }} </th>
                            <td>{{ $user->email }}</td>
                            <td><a href="{{ route('users.show', $user->id) }}" class="btn btn-default btn-sm">View Projects</a></td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection