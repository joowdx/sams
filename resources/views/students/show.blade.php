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
            <div class="card-header">Student</div>
            <div><i class="fa fa-user-circle" id="user" aria-hidden="true"></i></div>
            <h3>ID: {{ $student->uid }}</h3>
            <h1>{{ $student->name }}</h1>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card px-2">
            <div class="card-header pb-1">
                <h3 class="card-title">Courses</h3>
            </div>
            <div class="card-body px-2 py-4" style="display: block;">
                <table class="table table-borderless table-hover projects">
                    <thead>
                        <tr>
                            <th style="width: 20%">
                                Code
                            </th>
                            <th style="width: 30%">
                                Course
                            </th>
                            <th style="width: 30%">
                                Period
                            </th>
                            <th style="width: 30%">
                                Schedule
                            </th>
                            <th style="width: 30%">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($student->courses as $course)
                        <tr onclick="window.location='{{ route('faculties.courses.show', [2, $course->id]) }}'" style="cursor: pointer">
                            <td class="align-middle">
                                <i class="fad fa-hashtag"></i>{{ $course->code }}
                                <br>
                            </td>
                            <td>
                                <b>{{ $course->title }}</b>
                                <br>
                                <li class="list-inline-item">
                                    <small>
                                        {{ $course->description }}
                                    </small>
                                </li>
                            </td>
                            <td>
                                {{ strtolower($course->academic_period->semester) }} Semester
                                <small>
                                    ({{ ($term = $course->academic_period->term) == 'SEMESTER' ? 'Sem' : (strtolower($term). 'Term') }})
                                </small>
                                <br>
                                <small>
                                    {{ $course->academic_period->school_year }}
                                </small>
                            </td>
                            <td>
                                {{ "$course->day_from - $course->day_to" }}
                                <small>
                                    ({{ $course->room->name }})
                                </small>
                                <br>
                                <small> {{ "$course->time_from - $course->time_to" }} </small>
                            </td>
                            <td class="align-middle">
                                <span class="badge badge-{{ ($course->pivot->status == 'dropped' ? 'danger' : ($course->pivot->status == 'warning' ? 'warning' : 'success'))  }}">{{ $course->pivot->status ?? 'ok' }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('table').DataTable({
            dom: 'ftp'
        });
    });
</script>
@endsection
