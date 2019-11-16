@extends('layouts.app')

@section('styles')
<style>

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
                <div class="row">

                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-header">Course Code</div>
                            <div class="card-body">
                                    {{ $course->code }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-header">Title</div>
                            <div class="card-body">
                                    {{ $course->title }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-header">Course Description</div>
                            <div class="card-body">
                                    {{ $course->description }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-header">Course Code</div>
                            <div class="card-body">
                                    {{ $course->code }}
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-header">Semester</div>
                            <div class="card-body">
                                    {{ $course->semester }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-header">Term</div>
                            <div class="card-body">
                                    {{ $course->code }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-header">Schedule</div>
                            <div class="card-body">
                                    {{ $course->day_from }} - {{ $course->day_to }} /
                                    {{ $course->time_from }} - {{ $course->time_to }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-header">Unit</div>
                            <div class="card-body">
                                    {{ $course->unit }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    {{-- <th scope="row">{{ $course->code }}</th>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->description }}</td>
                    <td>{{ $course->semester }}</td>
                    <td>{{ $course->term }}</td>
                    <td>{{ $course->day_from }} - {{ $course->day_to }} <br>
                        {{ $course->time_from }} - {{ $course->time_to }} </td>
                    <td>{{ $course->unit }}</td>
                </tr>
            </tbody>
        </table>
    </div> --}}
</div>
@endsection

@section('scripts')

@endsection
