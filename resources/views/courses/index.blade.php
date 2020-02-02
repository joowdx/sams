@extends('layouts.app')

@section('styles')
<style>

</style>
@endsection

@section('content')

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
                            Name
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                    <tr onclick="window.location='{{ route('courses.show', [$course->id]) }}'" style="cursor: pointer">
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

@endsection

@section('scripts')
<script>

</script>
@endsection
