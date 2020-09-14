<?php use App\User;
      use App\Student;?>

@extends('layouts.main')

@section('title', 'Update Preferences')

@section('content')

<div class="row">
    <div class="col-md-9">

        <!-- Guided by Laravel Collective
                https://laravelcollective.com/docs/6.0/html -->
        {!! Form::model($student, ['route' => ['students.update', $student->id], 'method' => 'PUT']) !!}
        <div class="col-md-8">
            {{ Form::label('Preferences', 'Preferences:') }}
            {{ Form::textarea('preferences', null, ['class' => 'form-control']) }} 
            {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
            {!! Html::linkRoute('users.show', 'Cancel', array($student->id), array('class' =>'btn btn-danger btn-block')) !!}
        </div>
    </div>
    <div class="col-md-3">
    <div class="card bg-light mb-3" style="max-width: 18rem;">
                <div class="card-header">User Information</div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-12">User ID</dt>
                        <dd class="col-sm-12">{{ $student->id }}</dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-12">Student Number</dt>
                        <dd class="col-sm-12">{{ $student->username }}</dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-12">Email</dt>
                        <dd class="col-sm-12">{{ $student->email }}</dd>
                    </dl>
                </div>
            </div>
    </div>
</div>

@endsection