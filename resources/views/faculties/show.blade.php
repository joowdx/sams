@extends('layouts.app')

@section('styles')
<style>
    #user {
        display: inline-block;
        width: 150px;
        height: 150px;
        border-radius: 50%;

        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
    }
    li.info{
        display: inline-block;
    }
    .vl {
        border-left: 1px solid #181a1b !important;
    }
    .democlass {
        color: red;
    }
</style>
@endsection

@section('content')


<div class="row">
    <div id="circularMenu" class="circular-menu">
        <a class="floating-btn" onclick="document.getElementById('circularMenu').classList.toggle('active');">
            <i class="fa fa-bars" style="color:white"></i>
        </a>
        <menu class="items-wrapper">
            <a href="{{ $faculty->id }}/edit" class="menu-item">
                <i class="fa fa-edit"></i>
            </a>
            <a class="menu-item">
                <form method="post" id="deleteform" action="{{ route('faculties.destroy', $faculty->id) }}">
                    @method('DELETE')
                    @csrf
                    <button class="btn" type="submit"><i class="fa fa-trash" style="color:white"></i></button>
                </form>
            </a>
        </menu>
    </div>
    <div class="col-md-2">
        <div id="wrapper">
            <div><i class="fa fa-user-circle" id="user" aria-hidden="true"></i></div>
        </div>
    </div>
    <div class="col-md-10">
        <small>{{ $faculty->uid }}</small>
        <h1>{{ $faculty->name }}</h1>
        <hr>
        <ul class="nav info">
            <li class="col-md-2 text-center">
                <a href="{{ route('faculties.courses.index', $faculty->id) }}" class="list-group-item-action">
                    <h1> {{ $courses->count() }} </h1>
                    Current Courses
                </a>
            </li>
            <li class="vl"></li>
            <li class="col-md-2 text-center">
                <h1> {{ $students->count() }} </h1>
                Students
            </li>
        </ul>
        <hr>
    </div>
</div>
<div class="row mt-3">


    <div class="col-md-8">
        <div class="card px-2">
            <div class="card-header pb-1">
                <h3 class="card-title">Students</h3>
            </div>
            <div class="card-body px-2 py-4" style="display: block;">
                <table class="table table-borderless projects">
                    <thead>
                        <tr>
                            <th style="width: 20%">
                                Name
                            </th>
                            <th style="width: 30%">
                                Courses
                            </th>
                            <th style="width: 8%" class="text-center">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                        <tr>
                            <td>
                                <a href="{{ route('students.show', $student->id) }}" class="list-group-item-action">
                                    {{ $student->name }}
                                </a>
                                <br>
                                <small>
                                    {{ $student->uid }}
                                </small>
                            </td>
                            <td>
                                <ul class="list-inline">
                                    @foreach ($student->courses as $course)
                                    <li class="list-inline-item">
                                        <a href="{{ route('faculties.courses.show', [$faculty->id, $course->id]) }}" class="list-group-item-action">
                                            {{ $course->title }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="project-state">
                                <span class="badge badge-success">Success</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    {{-- <div class="col-md-8">
        <ul class="nav">
            <li><h1 id="haha">Students</h1></li>
            <li class="col-md-5">
                <small>Student Percentage</small>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped" id="instudent"  role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="50"></div>
                </div>
            </li>
        </ul>
        <table id="studentstable" class="table table-bordered" style="cursor:pointer;">
            <thead class="bg-custom">
                <tr>
                    <th scope="col" hidden>Student ID</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Student Course</th>
                    <th scope="col">Unexcused Absence</th>
                    <th scope="col">Excused Absence</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($course->students as $student)
                <tr>
                    <th scope="row" hidden>{{ $student->id }}</th>
                    <td> {{ $student->name }} </td>
                    <td>BSIT</td>
                    <td>6</td>
                    <td>9</td>
                    <td>
                        <div class="emphasis">
                            <form method="post" id="studentdeleteform" action="{{ route('students.destroy', $student->id) }}">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger btn-block btn-delete" type="submit"><span class="fa fa-trash"></span></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}
</div>

@endsection

@section('scripts')
<script>

</script>
@endsection
