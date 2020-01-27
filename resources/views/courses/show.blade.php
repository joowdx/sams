@extends('layouts.app')

@section('styles')
<style>
</style>
@endsection

@section('content')
<div class="row">

    <div id="circularMenu" class="circular-menu">

        <a class="floating-btn" onclick="document.getElementById('circularMenu').classList.toggle('active');">
            <i class="fa fa-bars" style="color:white"></i>
        </a>

        <menu class="items-wrapper">

            <a href="{{ $course->id }}/edit" class="menu-item">
                <i class="fa fa-edit"></i>
            </a>

            <a class="menu-item">
                <form method="post" id="deleteform" action="{{ route('courses.destroy', $course->id) }}">
                    @method('DELETE')
                    @csrf
                    <button class="btn" type="submit"><i class="fa fa-trash" style="color:white"></i></button>
                </form>
            </a>

        </menu>

    </div>

    <div class="col-md-12 row">
        {{-- <div class="card border-danger">
            <div class="card-header bg-custom">
                <h6>{{ $course->description }}</h6>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item">Code: {{ $course->code }}</li>
                    <li class="list-group-item">Code: {{ $course->code }}</li>
                    <li class="list-group-item">Title: {{ $course->title }}</li>
                    <li class="list-group-item">School Year: {{ @$course->academic_period->school_year }}</li>
                    <li class="list-group-item">Semester: {{ @$course->academic_period->semester }}</li>
                    <li class="list-group-item">Term: {{ @$course->academic_period->term }}</li>
                    <li class="list-group-item">Schedule: {{ $course->day_from }} - {{ $course->day_to }} /
                        {{ $course->time_from }} - {{ $course->time_to }}
                    </li>
                    <li class="list-group-item">Units: {{ $course->units }}</li>
                </ul>
            </div>
        </div> --}}
        <div class="col-md-6 mb-2 col-lg-4">
            <dl class="mb-0">
                <dt class="d-inline">Code: </dt>
                <dd class="d-inline">{{ $course->code }}</dd>
            </dl>
            <dl class="mb-0">
                <dt class="d-inline">Title: </dt>
                <dd class="d-inline">{{ $course->title }}</dd>
            </dl>
            <dl class="mb-0">
                <dt class="d-inline">Description: </dt>
                <dd class="d-inline">{{ $course->description }}</dd>
            </dl>
        </div>
        <div class="col-md-6 mb-2 col-lg-4">
            <dl class="mb-0">
                <dt class="d-inline">Instructor: </dt>
                <dd class="d-inline">
                    <a style="text-decoration: none;" href="{{ route("faculties.show", $course->faculty->id) }}"> {{ $course->faculty->name }} </a>
                </dd>
            </dl>
            <dl class="mb-0">
                <dt class="d-inline">Schedule: </dt>
                <dd class="d-inline">{{ $course->day_from."-".$course->day_to." ".$course->time_from."-".$course->time_to }}</dd>
            </dl>
            <dl class="mb-0">
                <dt class="d-inline">Room: </dt>
                <dd class="d-inline">{{ $course->room->name }}</dd>
            </dl>
        </div>
        <div class="col-md-6 mb-2 col-lg-4">
            <dl class="mb-0">
                <dt class="d-inline">Academic Period: </dt>
                <dd class="d-inline">{{ $course->academic_period->semester." ".substr($course->academic_period->term == "SEMESTER" ? $course->academic_period->term : $course->academic_period->term . "TERM", 0, $course->academic_period->term == "SEMESTER" ?  3 : null)." ".$course->academic_period->school_year }}</dd>
            </dl>
            <dl class="mb-0">
                <dt class="d-inline">Units: </dt>
                <dd class="d-inline">{{ $course->units }}</dd>
            </dl>
            <dl class="mb-0">
                <dt class="d-inline">Students: </dt>
                <dd class="d-inline">{{ $course->students->count() }}</dd>
            </dl>
        </div>
    </div>

</div>{{-- row --}}

<div class="row">
    <div class="col-md-12">

        <div class="card border-danger">

            <div class="card-header bg-custom">
                <h6>Records</h6>
            </div>

            <div class="card-body">
                <div class="wrapper">
                    <div class="scrollable-table">
                        <table class="table-borderless table-striped table-header-rotated">
                            <thead>
                                <tr>
                                    <!-- First column header is not rotated -->
                                    <th></th>
                                    <!-- Following headers are rotated -->
                                    @foreach ($days as $day)
                                    <th class="rotate-45"><div><span class="mb-2">{{ $day }}</span></div></th>
                                    @endforeach

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($course->students as $student)

                                <tr>
                                    <td class="headcol"> {{ $student->name }} </td>
                                    @foreach ($days as $day)
                                    <td>
                                        @switch($course->haslogged($student, Carbon\Carbon::createFromFormat('d-m-y', explode(' ', $day)[1]))->remarks ?? '')
                                        @case('ok')
                                        <i class="fa fa-fw fad fa-check-circle"></i>
                                        @break
                                        @case('late')
                                        {{-- {{ $course->haslogged($student, Carbon\Carbon::createFromFormat('d-m-y', explode(' ', $day)[1]))->created_at->format('H:i:s') }} --}}
                                        <i class="fa fa-fw fad fa-scrubber"></i>
                                        @break
                                        @default
                                        -
                                        @endswitch
                                        {{-- <i class="{{ ($r = ( ?? '') == 'ok' ? 'fad fa-fw fa-check-circle' : ($r == 'late' ? 'fad fa-fw fa-scrubber' : '' ) }}"></i> --}}
                                    </td>
                                    {{-- @if ($remark->remarks == 'fail')
                                    <td>
                                        <i class="fa fa-user-times" style="color:red"></i>
                                    </td>
                                    @else
                                    <td>
                                        <i class="fa fa-user-check" style="color:blue"></i>
                                    </td>
                                    @endif --}}
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
@endsection

@section('scripts')
<script>

</script>
@endsection
