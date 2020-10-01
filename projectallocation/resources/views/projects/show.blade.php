<?php use App\Project; 
      use App\User; ?>

@extends('layouts.main')

@section('title', 'Project Information')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h1>{{ $project->name }}</h1><hr>
        </div>
    
    <div class="col-md-8">
        <div class="card bg-light mb-3">
            <div class="card-header">Project Information</div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Project ID</dt>
                        <dd class="col-sm-9">{{ $project->id }}</a></dd>
                    </dl> 
                    <dl class="row">
                        <dt class="col-sm-3">Code</dt>
                        <dd class="col-sm-9">{{ $project->code }}</a></dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-3">Name</dt>
                        <dd class="col-sm-9">{{ $project->name }}</a></dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-3">Offered by</dt>
                        <dd class="col-sm-9">{{ User::find($project->lecturer_id)->firstName . ' ' . User::find($project->lecturer_id)->lastName }}</a></dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-3">Description</dt>
                        <dd class="col-sm-9">{{ $project->description }}</a></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection