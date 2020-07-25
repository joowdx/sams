@extends('layouts.app')

@section('styles')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="card card-dark">
                <div class="card-header">{{ __('Personal Info') }}</div>

                <div class="card-body">
                    <br>
                    <form method="post" action="{{ route('faculties.update', $faculty->id) }}">
                        @csrf
                        @method('put')
                        <input type="hidden" name="type" value="info">

                        <div class="form-group row">
                            <label for="uid" class="col-md-4 col-form-label text-md-right">{{ __('UID') }}</label>

                            <div class="col-md-6">
                                <input id="uid" type="text" class="form-control @error('uid') is-invalid @enderror" name="uid" autocomplete="new-uid" oninput="this.value=this.value.replace(/[^\d]/,'')" name="uid" value="{{ $faculty->uid }}">

                                @error('uid')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="program" class="col-md-4 col-form-label text-md-right">Program</label>

                            <div class="col-md-6">
                                <select id="program" name="program_id" class="selectpicker" data-width="100%" data-live-search="true">
                                    @foreach ($programs as $program)
                                    <option value="{{ $program->id }}" {{ @$program->faculty->id == $faculty->id ? 'selected' : '' }}> {{ $program->shortname }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="new-name" name="name" value="{{ $faculty->name }}">

                                @error('name')
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


        <div class="col-md-7">
            <div class="card card-dark">
                <div class="card-header">{{ __('Courses') }}</div>

                <div class="card-body">
                    <br>
                    <form method="post" action="{{ route('faculties.update', $faculty->id) }}">
                        @csrf
                        @method('put')

                        <input type="hidden" name="type" value="courses">

                        <div class="form-group row">
                            <label for="courses" class="col-md-4 col-form-label text-md-right">Courses</label>

                            <div class="col-md-6">
                                <select id="courses" name="courses[]" class="selectpicker" multiple data-width="100%" data-live-search="true">
                                    @foreach ($courses as $course)
                                    <option value="{{ $course->id }}" {{ $faculty->courses->contains($course->id) ? 'selected' : '' }}> {{ $course->code . ' - ' . $course->title }} </option>
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
@endsection

@section('scripts')

@endsection
