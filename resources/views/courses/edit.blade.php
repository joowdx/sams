@extends('layouts.app')

@section('styles')
<style>
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="card card-dark">
                <div class="card-header">Course Info</div>

                <div class="card-body">
                    <form method="post" action="{{ route('courses.update', $course->id) }}">
                        @csrf
                        @method('put')

                        <input type="hidden" name="type" value="info">

                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">Code</label>

                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" autocomplete="new-code" oninput="this.value=this.value.replace(/[^\d]/,'')" placeholder="CODE" value="{{ old('code') ?? $course->code }}">

                                @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" autocomplete="new-title" placeholder="TITLE"  value="{{ old('title') ?? $course->title }}">

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="new-description" placeholder="DESCRIPTION"  value="{{ old('description') ?? $course->description }}">

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="semester" class="col-md-4 col-form-label text-md-right">Semester</label>

                            <div class="col-md-6">
                                <select id="semester" name="semester" class="selectpicker" title="SEMESTER" data-width="100%">
                                    <option value="1ST" {{ (old('semester') == '1ST' || @$course->academic_period->semester == '1ST')? 'selected' : '' }}> 1ST </option>
                                    <option value="2ND" {{ (old('semester') == '2ND' || @$course->academic_period->semester == '2ND') ? 'selected' : '' }}> 2ND </option>
                                    <option value="SUMMER" {{ (old('semester') == 'SUMMER' || @$course->academic_period->semester == 'SUMMER') ? 'selected' : '' }}> SUMMER </option>
                                </select>

                                @error('semester')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="term" class="col-md-4 col-form-label text-md-right">Term</label>

                            <div class="col-md-6">
                                <select id="term" name="term" class="selectpicker" title="TERM" data-width="100%">
                                    <option value="1ST" {{ (old('term') == '1ST' || @$course->academic_period->term == '1ST') ? 'selected' : '' }}> 1ST </option>
                                    <option value="2ND" {{ (old('term') == '2ND' || @$course->academic_period->term == '2ND') ? 'selected' : '' }}> 2ND </option>
                                    <option value="SEMESTER" {{ (old('term') == 'SUMMER' || @$course->academic_period->term == 'SEMESTER') ? 'selected' : '' }}> SEMESTER </option>
                                </select>

                                @error('term')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="day_from" class="col-md-4 col-form-label text-md-right">Day</label>

                            <div class="col-md-3">
                                <select id="day_from" name="day_from" class="selectpicker" title="FROM" data-width="100%">
                                    <option value="Mon" {{ (old('day_from') ?? $course->day_from) == 'Mon' ? 'selected' : '' }}> Monday </option>
                                    <option value="Tue" {{ (old('day_from') ?? $course->day_from) == 'Tue' ? 'selected' : '' }}> Tuesday </option>
                                    <option value="Wed" {{ (old('day_from') ?? $course->day_from) == 'Wed' ? 'selected' : '' }}> Wednesday </option>
                                    <option value="Thu" {{ (old('day_from') ?? $course->day_from) == 'Thu' ? 'selected' : '' }}> Thursday </option>
                                    <option value="Fri" {{ (old('day_from') ?? $course->day_from) == 'Fri' ? 'selected' : '' }}> Friday </option>
                                    <option value="Sat" {{ (old('day_from') ?? $course->day_from) == 'Sat' ? 'selected' : '' }}> Saturday </option>
                                    <option value="Sun" {{ (old('day_from') ?? $course->day_from) == 'Sun' ? 'selected' : '' }}> Sunday </option>
                                </select>

                            </div>
                            @error('day_from')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <div class="col-md-3">
                                <select id="day_to" name="day_to" class="selectpicker" title="TO" data-width="100%">
                                    <option value="Mon" {{ (old('day_to') ?? $course->day_to) == 'Mon' ? 'selected' : '' }}> Monday </option>
                                    <option value="Tue" {{ (old('day_to') ?? $course->day_to) == 'Tue' ? 'selected' : '' }}> Tuesday </option>
                                    <option value="Wed" {{ (old('day_to') ?? $course->day_to) == 'Wed' ? 'selected' : '' }}> Wednesday </option>
                                    <option value="Thu" {{ (old('day_to') ?? $course->day_to) == 'Thu' ? 'selected' : '' }}> Thursday </option>
                                    <option value="Fri" {{ (old('day_to') ?? $course->day_to) == 'Fri' ? 'selected' : '' }}> Friday </option>
                                    <option value="Sat" {{ (old('day_to') ?? $course->day_to) == 'Sat' ? 'selected' : '' }}> Saturday </option>
                                    <option value="Sun" {{ (old('day_to') ?? $course->day_to) == 'Sun' ? 'selected' : '' }}> Sunday </option>
                                </select>
                            </div>
                            @error('day_to')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="time_from" class="col-md-4 col-form-label text-md-right">Time</label>

                            <div class="col-md-3">
                                <input id="time_from" type="text" class="form-control @error('time_from') is-invalid @enderror" name="time_from" autocomplete="new-time_from" placeholder="FROM" value="{{ old('time_from') ?? $course->time_from }}">

                                @error('time_from')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <input id="time_to" type="text" class="form-control @error('time_to') is-invalid @enderror" name="time_to" autocomplete="new-time_to" placeholder="TO" value="{{ old('time_to') ?? $course->time_to }}">

                                @error('time_to')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="units" class="col-md-4 col-form-label text-md-right">Unit</label>

                            <div class="col-md-6">
                                <input id="units" type="text" class="form-control @error('units') is-invalid @enderror" name="units" autocomplete="new-units" oninput="this.value=this.value.replace(/[^\d]/,'')" placeholder="Units" value="{{ old('units') ?? $course->units }}">

                                @error('units')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark" id="btnsave" style="float:right;">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div>
                <div class="card card-dark">
                    <div class="card-header">Faculty</div>

                    <div class="card-body">
                        <br>
                        <form method="post" action="{{ route('courses.update', $course->id) }}">
                            @csrf
                            @method('put')

                            <input type="hidden" name="type" value="faculty">

                            <div class="form-group row">
                                <label for="faculty_id" class="col-md-4 col-form-label text-md-right">Faculty</label>

                                <div class="col-md-6">
                                    <select id="faculty_id" name="faculty_id" data-width="100%" data-live-search="true">
                                        @foreach ($faculties as $faculty)
                                        <option value="{{ $faculty->id }}" {{ $faculty->courses->contains($course->id) ? 'selected' : '' }}> {{ ($faculty->school_id ? $faculty->school_id.' - ' : '').$faculty->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-dark" id="btnsave" style="float:right;">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div>
                <div class="card card-dark">
                    <div class="card-header">Students</div>

                    <div class="card-body">
                        <br>
                        <form method="post" action="{{ route('courses.update', $course->id) }}">
                            @csrf
                            @method('put')

                            <input type="hidden" name="type" value="students">

                            <div class="form-group row">
                                <label for="students" class="col-md-4 col-form-label text-md-right">Students</label>

                                <div class="col-md-6">
                                    <select name="students[]" multiple data-width="100%">
                                        @foreach ($students as $student)
                                        <option value="{{ $student->id }}" {{ $student->courses->contains($course->id) ? 'selected' : '' }}> {{ ($student->school_id ? $student->school_id.' - ' : '').$student->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-dark" id="btnsave" style="float:right;">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
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
