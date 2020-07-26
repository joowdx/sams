@extends('layouts.app')

@section('styles')
<style>

</style>
@endsection

@section('content')
<div class="col-md-12">
    <a href="{{ route('courses.create') }}" id="add" class="btn btn-primary"><span class="fa fa-plus"></span></a>
</div>

<div class="card">
    <div class="card-header p-2">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#current" data-toggle="tab">Current</a></li>
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
                                    Faculty
                                </th>
                                <th>
                                    Schedule
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($current as $course)
                            <tr onclick="window.location='{{ route('courses.show', [$course->id]) }}'" style="cursor: pointer">
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
                                    @if ($period = $course->academic_period)
                                    <p class="m-0 p-0">
                                        @if($period->term != 'SEMESTER' && $period->semester != 'SUMMER')
                                            <b>{{ $period->semester }}</b> <small> Sem </small>/
                                            <b>{{ $period->term }} </b> <small> Term </small>
                                        @else
                                            <b>{{ @$period->semester }}</b>
                                            @if(@$period->semester != 'SUMMER') <small> Sem </small> @endif
                                        @endif
                                    </p>
                                    <small>
                                        SY: {{ $period->school_year }}
                                    </small>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ @$course->faculty->name }}</strong> <br>
                                    <small> {{ @$course->faculty->program->shortname  }} ( {{ @$course->faculty->program->department->shortname }} ) </small>
                                </td>
                                <td>
                                    {{ "$course->day_from - $course->day_to" }}
                                    <small>
                                        ({{ $course->room ? @$course->room->name : '' }})
                                    </small>
                                    <br>
                                    <small> {{ "$course->time_from - $course->time_to" }} </small>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="all">
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
                                    Faculty
                                </th>
                                <th>
                                    Schedule
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                            <tr onclick="window.location='{{ route('courses.show', [$course->id]) }}'" style="cursor: pointer">
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
                                    @if($period = $course->academic_period)
                                    <p class="m-0 p-0">
                                        @if($period->term != 'SEMESTER' && $period->semester != 'SUMMER')
                                            <b>{{ $period->semester }}</b> <small> Sem </small>/
                                            <b>{{ $period->term }} </b> <small> Term </small>
                                        @else
                                            <b>{{ $period->semester }}</b>
                                            @if($period->semester != 'SUMMER') <small> Sem </small> @endif
                                        @endif
                                    </p>
                                    <small>
                                        SY: {{ $period->school_year }}
                                    </small>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ @$course->faculty->name }}</strong> <br>
                                    <small> {{ @$course->faculty->program->shortname  }} ( {{ @$course->faculty->program->department->shortname }} ) </small>
                                </td>
                                <td>
                                    {{ "$course->day_from - $course->day_to" }}
                                    <small>
                                        ({{ $course->room ? @$course->room->name : '' }})
                                    </small>
                                    <br>
                                    <small> {{ "$course->time_from - $course->time_to" }} </small>
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
@endsection

@section('scripts')
<script>

</script>
@endsection
