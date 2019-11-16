@extends('layouts.app')

@section('styles')
<style>
.upright{
    text-align:center;
    white-space:nowrap;
    transform-origin:50% 50%;
    -webkit-transform: rotate(-90deg);
    -moz-transform: rotate(-90deg);
    -ms-transform: rotate(-90deg);
    -o-transform: rotate(-90deg);
    transform: rotate(-90deg);
}
.upright::before{
    content:'';
    padding-top:110%;/* takes width as reference, + 10% for faking some extra padding */
    display:inline-block;
    vertical-align:middle;
}
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-dark">
                <h3>{{ $course->description }}</h3>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item">Course Code: {{ $course->code }}</li>
                    <li class="list-group-item">Course Code: {{ $course->code }}</li>
                    <li class="list-group-item">Course Title: {{ $course->title }}</li>
                    <li class="list-group-item">Semester: {{ $course->semester }}</li>
                    <li class="list-group-item">Term: {{ $course->term }}</li>
                    <li class="list-group-item"> Schedule: {{ $course->day_from }} - {{ $course->day_to }} /
                            {{ $course->time_from }} - {{ $course->time_to }}
                    </li>
                    <li class="list-group-item">Units: {{ $course->unit }}</li>
                </ul>


            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="card">

            <div class="card-header bg-dark">
                <h3>{{ $course->description }} students</h3>
            </div>

            <div class="card-body">

                <table id="studentstable" class="table table-bordered table-responsive" style="cursor:pointer;">
                    <thead>
                            <tr>
                                <th scope="col">Student Name</th>
                                @foreach ($logs as $date)
                                    <th class="upright" scope="col">{{ $date->created_at->format('d-m-y') }}</th>
                                @endforeach
                            </tr>
                    </thead>
                    <tbody>
                        @foreach ($course->students as $student)
                            <tr class="text-center">
                                <td> {{ $student->name }} </td>
                                @foreach ($logs as $remark)
                                    @if ($remark->remarks == 'fail')
                                        <td>
                                            <i class="fa fa-user-times" style="color:red"></i>
                                        </td>
                                    @else
                                        <td>
                                            <i class="fa fa-user-check" style="color:blue"></i>
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>

    </div>
</div>
@endsection

@section('scripts')

@endsection
