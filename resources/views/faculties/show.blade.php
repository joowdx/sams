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
@endsection

@section('content')


    <div class="row">

        <div class="col-md-3">
            <div class="card text-center">
                    <div class="card-header">Teacher</div>
                    <div><i class="fa fa-user-circle" id="user" aria-hidden="true"></i></div>
                        <h1>ID: {{ $faculty->uid }}</h1>
                        <h1>{{ $faculty->name }}</h1>
                        <p class="title">CEO & Founder, Example</p>
                        <p>Harvard University</p>
            </div>
        </div>


        <div class="col-md-9">
            <h1>Classes Table</h1>
            <table id="classestable" class="table table-bordered" style="cursor:pointer;">
                <thead>
                    <tr>
                        <th scope="col">Course ID</th>
                        <th scope="col">Course Code</th>
                        <th scope="col">Course Title</th>
                        <th scope="col">Course Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($courses as $course)
                        <th scope="row">{{ $course->id }}</th>
                        <td>{{ $course->code }}</td>
                        <td>{{ $course->title }}</td>
                        <td>{{ $course->description }}</td>
                    @endforeach
                    </tr>
                </tbody>
            </table>

            <h1>Students Table Table</h1>
            <table id="students table" class="table table-bordered" style="cursor:pointer;">
                <thead>
                    <tr>
                        <th scope="col">Student ID</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Student Course</th>
                        <th scope="col">Number of Unexcused Absences</th>
                        <th scope="col">Number of Excused Absences</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">50386</th>
                        <td>Gene Rellanos</td>
                        <td>BSIT</td>
                        <td>6</td>
                        <td>9</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

@endsection

@section('scripts')


@endsection
