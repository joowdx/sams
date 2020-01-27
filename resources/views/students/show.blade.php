@extends('layouts.app')
@section('styles')
<style>
#user {
  display: inline-block;
  width: 150px;
  height: 150px;
  border-radius: 50%;
  object-fit: cover;

  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
}
i{
    text-align: center;
}
</style>
@section('content')


<div class="row">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-header">Students</div>
            <div><i class="fa fa-user-circle" id="user" aria-hidden="true"></i></div>
            <h3>ID: {{ $studentDetails[0]->uid }}</h3>
            <h1>{{ $studentDetails[0]->name }}</h1>
        </div>
    </div>
    <div class="col-md-9">
    <h1>Classes Table</h1>
            <table id="classestable" class="table table-striped table-bordered"  style="cursor:pointer;width:100%;background-color:white;">
                <thead>
                    <tr>
                        <th scope="col">Course ID</th>
                        <th scope="col">Course Code</th>
                        <th scope="col">Course Title</th>
                        <th scope="col">Course Description</th>
                        <th scope="col">Course Type</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($studentDetails as $course)
                    <tr>
                    @if ($course->course_id != null)
                        <th scope="row">{{ $course->id }}</th>
                        <td scope="row">{{ $course->code }}</td>
                        <td scope="row">{{ $course->title }}</td>
                        <td scope="row">{{ $course->description }}</td>
                        <td scope="row">{{ $course->academic_period_id }}</td>
                     @endif  
                    </tr>
                    @endforeach
                </tbody>
            </table>
    
    </div>
</div>
@endsection
