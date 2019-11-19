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

    <div class="col-md-12">
        <div class="card">
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
        </div>
    </div>

</div>{{-- row --}}

<div class="row">
    <div class="col-md-12">

        <div class="card">

            <div class="card-header bg-custom">
                <h6>{{ $course->description }} students</h6>
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
                                <th class="rotate-45"><div><span>{{ $day }}</span></div></th>
                            @endforeach

                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($course->students as $student)
                            <tr>
                                <td class="headcol"> {{ $student->name }} </td>
                                @foreach ($days as $day)
                                <td>
                                    ha
                                    <i class="{{ ($r = ($course->haslogged($student, Carbon\Carbon::createFromFormat('d-m-y', explode(' ', $day)[1])))->remarks ?? '') == 'ok' ? 'fad fa-fw fa-check-circle' : ($r == 'late' ? 'fad fa-fw fa-scrubber' : '' ) }}"></i>
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
