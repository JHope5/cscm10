<?php use App\User; ?>

@extends('layouts.main')

@section('title', 'Update Preferences')

@section('content')

<div class="row">
    <div class="col-md-9">

        <!-- Helped with Laravel Collective
                https://laravelcollective.com/docs/6.0/html -->
        {!! Form::model($user, ['route' => ['updateprojectpreferences', $user->id], 'method' => 'PUT']) !!}
        <div class="col-md-8">
            {{ Form::label('Preferences', 'Preferences:') }}
            {{ Form::textarea('preferences', null, ['class' => 'form-control']) }} 
            {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
            {!! Html::linkRoute('users.show', 'Cancel', array($user->id), array('class' =>'btn btn-danger btn-block')) !!}
        </div>
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