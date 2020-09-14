<?php use App\User; ?>

@extends('layouts.main')

@section('title', '- Edit Project')

@section('content')

<div class="row">
    <div class="col-md-8">

        <!-- Helped with Laravel Collective
                https://laravelcollective.com/docs/6.0/html -->
        {!! Form::model($project, ['route' => ['projects.update', $project->id], 'method' => 'PUT', 'files' => true]) !!}
        <div class="col-md-8">
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name', null, ['class' => 'form-control input-lg']) }}
            <br>
            {{ Form::label('code', "Code:") }}
            {{ Form::text('code', null, ['class' => 'form-control']) }}
            <br>
            {{ Form::label('description', 'Description:') }}
            {{ Form::textarea('description', null, ['class' => 'form-control']) }} 
        </div>
    </div>
    <div class="col-md-4">
            <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">Project Information - {{$project->code}}</div>
                    <div class="card-body">
                      <dl class="row">
                          <dt class="col-sm-6">Name</dt>
                          <dd class="col-sm-6">{{ $project->name }}</dd>
                      </dl>
                      <dl class="row">
                          <dt class="col-sm-6">Offered By</dt>
                          <dd class="col-sm-6"><a href="../../users/{{$project->lecturer_id}}">{{ User::find($project->lecturer_id)->firstName . ' ' . User::find($project->lecturer_id)->lastName }}</a></dd>
                      </dl>
                      <dl class="row">
                          <dt class="col-sm-6">Created At</dt>
                          <dd class="col-sm-6">{{ date('F jS, Y H:i', strtotime($project->created_at)) }}</dd>
                      </dl>
                      <dl class="row">
                            <dt class="col-sm-6">Last Updated</dt>
                            <dd class="col-sm-6">{{ date('F jS, Y H:i', strtotime($project->updated_at)) }}</dd>
                        </dl>
                      <hr>
                      <div class="row">
                          <div class="col-sm-7">
                              {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
                          </div>
                          <div class="col-sm-5">
                              {!! Html::linkRoute('projects.show', 'Cancel', array($project->id), array('class' =>'btn btn-danger btn-block')) !!}
                          </div>
                          </div>
                      </div>
                    </div>
                  </div>
    </div>
</div>

@endsection