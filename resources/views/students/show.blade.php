@extends('layouts.app')

@section('styles')
<style>

</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card card-outline">
            <div class="card-body box-profile">
                <strong><i class="fa-fw fad fa-tag mr-1"></i> UID </strong>
                <p class="text-muted">
                    {{ $student->uid ?? 'no uid set' }}
                </p>
                <strong><i class="fa-fw fad fa-id-card-alt mr-1"></i> School ID </strong>
                <p class="text-muted">
                    {{ $student->school_id ?? 'no school id set' }}
                </p>
                <strong><i class="fa-fw fad fa-ball-pile mr-1"></i> Department </strong>
                <p class="text-muted">
                    {{ $student->department->name ?? 'no department set' }}
                </p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <strong><i class="fa-fw fad fa-info mr-1"></i> Other info </strong>
                <ul class="list-group list-group-unbordered my-3">
                    <li class="list-group-item">
                        <b>Currently Enrolled</b>
                        <a class="float-right">
                            <span class="badge badge-{{ $student->enrolled() ? 'success' : 'danger' }}">
                                {{ $student->enrolled() ? 'yes' : 'no'}}
                            </span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <b>Current Courses Enrolled</b> <a class="float-right">{{ $student->enrolledcourses()->count() }}</a>
                    </li>
                </ul>

            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#current" data-toggle="tab">Currently Enrolled</a></li>
                    <li class="nav-item"><a class="nav-link" href="#all" data-toggle="tab">All Courses</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="current">
                        <div class="p-2" style="display: block;">
                            <table class="table table-borderless table-hover projects">
                                <thead>
                                    <tr>
                                        <th>
                                            <i class="fad fa-hashtag"></i>
                                        </th>
                                        <th>
                                            Code
                                        </th>
                                        <th>
                                            Course
                                        </th>
                                        <th>
                                            Period
                                        </th>
                                        <th>
                                            Schedule
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($student->enrolledcourses() as $course)
                                    <tr onclick="window.location='{{ route('faculties.courses.show', [2, $course->id]) }}'" style="cursor: pointer">
                                        <td class="align-middle">
                                            {{ $loop->iteration }}
                                        </td>
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
                    </div>
                    <div class="tab-pane" id="students">
                        <div class="p-2" style="display: block;">
                            <table class="table table-borderless table-hover projects">
                                <thead>
                                    <tr>
                                        <th>
                                            <i class="fad fa-hashtag"></i>
                                        </th>
                                        <th>
                                            Code
                                        </th>
                                        <th>
                                            Course
                                        </th>
                                        <th>
                                            Period
                                        </th>
                                        <th>
                                            Schedule
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($student->courses as $course)
                                    <tr onclick="window.location='{{ route('faculties.courses.show', [2, $course->id]) }}'" style="cursor: pointer">
                                        <td class="align-middle">
                                            {{ $loop->iteration }}
                                        </td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>

</script>
@endsection
