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
</div>

<div class="row">
    <div class="col-md-12">

        <div class="card">

            <div class="card-header bg-custom">
                <h6>{{ $course->description }} students</h6>
            </div>

            <div class="card-body">

                {{-- <div class="wrapper">
                <div class="scroller">
                 <table id="studentstable" class="table table-bordered table-responsive" style="cursor:pointer;">
                    <thead>
                        <tr>
                            <th scope="col">Student Name</th>
                            @foreach ($days as $day)
                            <th class="upright" scope="col">{{ $day }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($course->students as $student)
                        <tr class="text-center">
                            <td> {{ $student->name }} </td>
                            @foreach ($days as $day)
                            <td>
                                {{-- {{$student->name}} --}}
                                {{-- <i class="
                                    {{ ($r = ($course->haslogged($student, Carbon\Carbon::createFromFormat('d-m-y', explode(' ', $day)[1])))->remarks ?? '') == 'ok' ? 'fad fa-fw fa-check-circle' : ($r == 'late' ? 'fad fa-fw fa-scrubber' : '' ) }}
                                "></i>
                            </td> --}}
                            {{-- @if ($remark->remarks == 'fail')
                            <td>
                                <i class="fa fa-user-times" style="color:red"></i>
                            </td>
                            @else
                            <td>
                                <i class="fa fa-user-check" style="color:blue"></i>
                            </td>
                            @endif --}}
                            {{-- @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                </div> --}}

                <div class="zui-wrapper">
                    <div class="zui-scroller">
                        <table class="zui-table">
                            <thead>
                                <tr>
                                    <th class="zui-sticky-col">Name</th>
                                    @foreach ($days as $day)
                                        <th class="upright" scope="col">{{ $day }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($course->students as $student)
                                <tr class="text-center">
                                    <td class="zui-sticky-col"> {{ $student->name }} </td>
                                    @foreach ($days as $day)
                                    <td>
                                        {{-- {{$student->name}} --}}
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
