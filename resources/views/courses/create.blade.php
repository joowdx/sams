@extends('layouts.app')

@section('styles')
<style>
.form-control {
    border: 0;
}
</style>
@endsection

@section('content')
<div class="container">
    {{ $errors }}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-dark">
                <div class="card-header">New course</div>

                <div class="card-body">
                    <form method="post" action="{{ route('courses.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">Code</label>

                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" autocomplete="new-code" oninput="this.value=this.value.replace(/[^\d]/,'')" placeholder="CODE" value="{{ old('code') }}">

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
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" required autocomplete="new-title" placeholder="TITLE"  value="{{ old('title') }}">

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
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="new-description" placeholder="DESCRIPTION"  value="{{ old('description') }}">

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
                                    <option value="1ST" {{ old('semester') == '1ST' ? 'selected' : '' }}> 1ST </option>
                                    <option value="2ND" {{ old('semester') == '2ND' ? 'selected' : '' }}> 2ND </option>
                                    <option value="SUMMER" {{ old('semester') == 'SUMMER' ? 'selected' : '' }}> SUMMER </option>
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
                                    <option value="1ST" {{ old('term') == '1ST' ? 'selected' : '' }}> 1ST </option>
                                    <option value="2ND" {{ old('term') == '2ND' ? 'selected' : '' }}> 2ND </option>
                                    <option value="SEMESTER" {{ old('term') == 'SUMMER' ? 'selected' : '' }}> SEMESTER </option>
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
                                    <option value="Mon" {{ old('day_from') == 'Mon' ? 'selected' : '' }}> Monday </option>
                                    <option value="Tue" {{ old('day_from') == 'Tue' ? 'selected' : '' }}> Tuesday </option>
                                    <option value="Wed" {{ old('day_from') == 'Wed' ? 'selected' : '' }}> Wednesday </option>
                                    <option value="Thu" {{ old('day_from') == 'Thu' ? 'selected' : '' }}> Thursday </option>
                                    <option value="Fri" {{ old('day_from') == 'Fri' ? 'selected' : '' }}> Friday </option>
                                    <option value="Sat" {{ old('day_from') == 'Sat' ? 'selected' : '' }}> Saturday </option>
                                    <option value="Sun" {{ old('day_from') == 'Sun' ? 'selected' : '' }}> Sunday </option>
                                </select>

                                @error('day_from')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <select id="day_to" name="day_to" class="selectpicker" title="TO" data-width="100%">
                                    <option value="Mon" {{ old('day_to') == 'Mon' ? 'selected' : '' }}> Monday </option>
                                    <option value="Tue" {{ old('day_to') == 'Tue' ? 'selected' : '' }}> Tuesday </option>
                                    <option value="Wed" {{ old('day_to') == 'Wed' ? 'selected' : '' }}> Wednesday </option>
                                    <option value="Thu" {{ old('day_to') == 'Thu' ? 'selected' : '' }}> Thursday </option>
                                    <option value="Fri" {{ old('day_to') == 'Fri' ? 'selected' : '' }}> Friday </option>
                                    <option value="Sat" {{ old('day_to') == 'Sat' ? 'selected' : '' }}> Saturday </option>
                                    <option value="Sun" {{ old('day_to') == 'Sun' ? 'selected' : '' }}> Sunday </option>
                                </select>

                                @error('day_to')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="time_from" class="col-md-4 col-form-label text-md-right">Time</label>

                            <div class="col-md-3">
                                <input id="time_from" type="text" class="form-control @error('time_from') is-invalid @enderror" name="time_from" required autocomplete="new-time_from" oninput="this.value=this.value.replace(/[^\d]/,'')" placeholder="FROM" value="{{ old('time_from') }}">

                                @error('time_from')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <input id="time_to" type="text" class="form-control @error('time_to') is-invalid @enderror" name="time_to" required autocomplete="new-time_to" oninput="this.value=this.value.replace(/[^\d]/,'')" placeholder="TO" value="{{ old('time_to') }}">

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
                                <input id="units" type="text" class="form-control @error('units') is-invalid @enderror" name="units" autocomplete="new-units" oninput="this.value=this.value.replace(/[^\d]/,'')" placeholder="Units" value="{{ old('units') }}">

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
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
