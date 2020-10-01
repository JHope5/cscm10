<?php use App\User;
      use App\Project;
      use App\Allocation; ?>

@extends('layouts.main')

@section('title', 'Allocations')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1>Project Allocations</h1>
        </div>
    </div>
    <div class="col-md-12">
        <hr>
    </div>
    <div class="pagination">
        {!! $allocations->links(); !!}
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>Student Number</th>
                    <th>Project Code</th>
                    <th>Project Name</th>
                    <th>Lecturer Name</th>
                    <th>Lecturer Email</th>
                </thead>

                <tbody>
                    @foreach($allocations as $allocation)
                    <?php $project = Project::where('code', $allocation->project_code)->first();
                          $projName = $project->name; ?>
                        <tr>
                            <td>{{ $allocation->student_number }} </td>
                            <td>{{ $allocation->project_code }}</td>
                            <td>{{ $projName }}
                            <td>{{ $allocation->lecturer_name }}</td>                       
                            <td>{{ $allocation->lecturer_email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {!! $allocations->links(); !!}
            </div>
        </div>
    </div>

@endsection