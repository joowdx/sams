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
                    {{ $student->schoolid ?? 'no school id set' }}
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
                    <li class="list-group-item">
                        <b>Overall Average Login Time</b><a id="resultAvg" class="float-right">
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#attendance" data-toggle="tab">Attendance</a></li>
                    <li class="nav-item"><a class="nav-link" href="#courses" data-toggle="tab">Courses</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="attendance">
                        {{-- <div class="p-2" style="display: block;">
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
                                            Absenteeism Rate
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
                                        <td>
                                            @switch($count = $student->logs()->where('course_id', $course->id)->count())
                                            @case(0)
                                                0
                                                @break
                                            @default
                                            {{ round(($student->logs()->where('remarks', 'absent')->where('course_id', $course->id)->count() /
                                            $student->logs()->where('course_id', $course->id)->count()) * 100, 2) }}{{"%"}}
                                            @endswitch
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge badge-{{ ($course->pivot->status == 'dropped' ? 'danger' : ($course->pivot->status == 'warning' ? 'warning' : 'success'))  }}">{{ $course->pivot->status ?? 'ok' }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> --}}
                        <div class="row">
                            <div class="form-group col">
                                <label for="schoolyear">School Year</label>
                                <select id="schoolyear">
                                    <option value="{{ $currentschoolyear }}"> Current </option>
                                    @foreach ($schoolyears as $schoolyear)
                                    <option value="{{ $schoolyear }}"> {{ $schoolyear }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="semester">Semester</label>
                                <select id="semester">
                                    <option value="{{ $currentsemester }}"> Current </option>
                                    @foreach ($semesters as $semester)
                                    <option value="{{ $semester }}"> {{ $semester }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="calendar"></div>
                    </div>
                    <div class="tab-pane" id="courses">
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

    <div class="col-md-3">
        <div class="card">
            <div class="card-header pb-1">
                <h3 class="card-title">Frequency</h3>
            </div>
            <div class="card-body px-2 py-4" style="display: block;">
                <canvas id="myChart" style="position: relative;" class="chartjs-render-monitor"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(e => {
        const source = e => `{{ url("api/students/$student->id") }}?schoolyear=${$('#schoolyear option:selected').val()}&semester=${$('#semester option:selected').val()}`;
        const attendance = new Calendar(document.getElementById('calendar'), {
            plugins: [ resourceTimelinePlugin, interactionPlugin ],
            schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
            defaultView: 'resourceTimelineWeek',
            firstDay: 1,
            height: 'auto',
            header: {left: 'title', right: 'prev,today,next',},
            lazyFetching: true,
            displayEventTime: false,
            slotDuration: { day: 1 },
            slotLabelFormat: [{ weekday: 'short', day: '2-digit' }],
            resourceColumns: [{ labelText: 'Course', width: '70%' },{ labelText: 'Late', field: 'late', width: '10%' },{ labelText: 'Excuse', field: 'excuse', width: '10%' },{ labelText: 'Absent', field: 'absent', width: '10%' },],
            resourceAreaWidth: '35%',
            resources: () => axios(source()).then(e => e.data.courses),
            events: () => axios(source()).then(e => e.data.logs),
            eventPositioned: info => {
                let icon = info.event.extendedProps.icon
                let title = $(info.el)
                if (icon !== undefined) {
                    title.css('height', '100%')
                    title.prepend("<i class='fad fa-" + icon + " mr-1'></i>")
                    title.addClass('m-0 border-0')
                    title.first('span').addClass('d-flex align-items-center')
                }
            },
        })
        attendance.render()
        $('#schoolyear').on('change', e => {
            attendance.refetchResources()
            attendance.refetchEvents()
        })
        $('#semester').on('change', e => {
            attendance.refetchResources()
            attendance.refetchEvents()
        })
    })
</script>
@endsection
