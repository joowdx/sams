@extends('layouts.app')

@section('styles')
<style>

</style>
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                New Program
            </div>

            <div class="card-body">
                <form method="post" action="{{ route('programs.store') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="new-name" placeholder="Name"  value="{{ old('name') }}">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="shortname" class="col-md-4 col-form-label text-md-right">Shortname</label>

                        <div class="col-md-6">
                            <input id="shortname" type="text" class="form-control @error('shortname') is-invalid @enderror" name="shortname" required autocomplete="new-shortname" placeholder="Shortname"  value="{{ old('shortname') }}">

                            @error('shortname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="department_id" class="col-md-4 col-form-label text-md-right">Department</label>

                        <div class="col-md-6">
                            <select id="department_id" name="department_id" class="selectpicker" data-width="100%" data-live-search="true" data-placeholder="Department">
                                <option></option>
                                @foreach ($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}> {{ $department->shortname }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="faculty_id" class="col-md-4 col-form-label text-md-right">Program Head</label>

                        <div class="col-md-6">
                            <select id="faculty_id" name="faculty_id" class="selectpicker form-control @error('faculty_id') is-invalid @enderror" data-width="100%" data-live-search="true" data-placeholder="Program Head">
                                <option></option>
                                @foreach ($faculties as $faculty)
                                <option value="{{ $faculty->id }}" {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}> {{ $faculty->name }} </option>
                                @endforeach
                            </select>
                            @error('faculty_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ "Empty!" }}</strong>
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
@endsection

@section('scripts')
<script>

</script>
@endsection
