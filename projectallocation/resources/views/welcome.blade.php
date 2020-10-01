<?php use App\Project;
      use App\User; ?>

@extends('layouts.main')

@section('title', 'Home')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="jumbotron">
      <h1>Swansea University Project Allocation</h1>
      <p class="lead">Please log in to select your preferences for projects!</p>
    </div>
  </div>
</div>
  <div class="row">
    <div class="col-md-8">
      
      <div class="project">
        <h2>Example Project</h2>
        <?php $project = Project::get()->random(); ?>
        <h3>{{ $project->name }} <small>offered by <a href="users/{{User::find($project->lecturer_id)->id}}">{{ User::find($project->lecturer_id)->firstName . ' ' . User::find($project->lecturer_id)->lastName }}</a></small></h3>
        <p>{{ substr($project->description, 0, 200) }}...</p>
        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary">Read More</a>
      </div>
      <hr>
    </div>
  </div>
</div>
@endsection