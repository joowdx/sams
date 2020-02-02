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
                <h3 class="profile-username">
                    {{ $course->description }}
                </h3>
                <hr>
                <strong><i class="fa-fw fad fa-calendar-week mr-1"></i> Period </strong>
                <p class="text-muted">
                    {{ strtolower($course->academic_period->semester) }} Semester
                    <small>
                        ({{ ($term = $course->academic_period->term) == 'SEMESTER' ? 'Sem' : (strtolower($term). 'Term') }})
                    </small>
                    <br>
                    <small>
                        {{ $course->academic_period->school_year }}
                    </small>
                </p>
                <strong><i class="fa-fw fad fa-calendar-alt mr-1"></i> Schedule </strong>
                <p class="text-muted">
                    {{ "$course->day_from - $course->day_to" }}
                    <small>
                        {{ "($course->time_from - $course->time_to)" }}
                    </small>
                    <br>
                    <small>
                        {{ @$course->room->name ?? 'no room set' }}
                    </small>
                </p>
                <strong><i class="fa-fw fad fa-weight-hanging mr-1"></i> Units </strong>
                <p class="text-muted">
                    {{ $course->units }}
                </p>
                <strong><i class="fa-fw fad fa-user-crown mr-1"></i> Faculty </strong>
                <p class="text-muted mb-0">
                    {{ @$course->faculty->name ?? 'no faculty set' }}
                </p>
                <hr>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <strong><i class="fa-fw fad fa-info mr-1"></i> Other info </strong>
                <ul class="list-group list-group-unbordered my-3">
                    <li class="list-group-item">
                        <b>Faculty Absences</b> <a class="float-right">{{ $course->faculty->logs()->where(['course_id' => $course->id, 'remarks' => 'absent'])->count() }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Students</b> <a class="float-right">{{ $course->students->count() }}</a>
                    </li>
                    {{-- <li class="list-group-item">
                        <b>Courses</b> <a class="float-right">{{ $department->courses->count() }}</a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#weekly" data-toggle="tab">Weekly</a></li>
                    <li class="nav-item"><a class="nav-link" href="#all" data-toggle="tab">All</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="weekly">
                        <div class="p-2" style="display: block;">
                        </div>
                    </div>
                    <div class="tab-pane" id="all">
                        <div class="p-2" style="display: block;">
                            <div class="wrapper">
                                <div class="scrollable-table">
                                    <table class="table-header-rotated no-datatable">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                @while ($day = $course->nextmeeting($day ?? $course->firstmeeting()->subDay()))
                                                @if($day->gt(today()))
                                                @break
                                                @endif
                                                <th class="rotate-45"><div><span class="mb-2">{{ $day->format('D y-m-d') }}</span></div></th>
                                                @endwhile
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="headcol text-light" style="background: #0009;"> {{ $course->faculty->name }} </td>
                                                @foreach ($course->faculty->logsto($course->id) as $log)
                                                <td style="background: #0009;">
                                                    @switch($log->remarks ?? '')
                                                    @case('ok')
                                                    <i class="fa fa-fw fad fa-check-circle text-success"></i>
                                                    @break
                                                    @case('late')
                                                    <i class="fa fa-fw fad fa-scrubber text-info"></i>
                                                    @break
                                                    @case('absent')
                                                    <i class="fa fa-fw fad fa-times-circle text-danger"></i>
                                                    @break
                                                    @default
                                                    -
                                                    @endswitch
                                                </td>
                                                @endforeach
                                            </tr>
                                            @foreach ($course->students as $student)
                                            <tr>
                                                <td class="headcol"> {{ $student->name }} </td>
                                                @foreach ($student->logsto($course->id) as $log)
                                                <td>
                                                    @switch($log->remarks ?? '')
                                                    @case('ok')
                                                    <i class="fa fa-fw fad fa-check-circle text-success"></i>
                                                    @break
                                                    @case('late')
                                                    <i class="fa fa-fw fad fa-scrubber text-info"></i>
                                                    @break
                                                    @case('absent')
                                                    <i class="fa fa-fw fad fa-times-circle text-danger"></i>
                                                    @break
                                                    @default
                                                    -
                                                    @endswitch
                                                </td>
                                                @endforeach
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
    </div>


    {{-- <div class="col-md-12">

        <div class="card">

            <div class="card-header bg-custom">
                <h6>Records</h6>
            </div>

            <div class="card-body">
                <div class="wrapper">
                    <div class="scrollable-table">

                    </div>
                </div>

            </div>

        </div>

    </div> --}}
</div>
@endsection

@section('scripts')
<script>

</script>
@endsection
