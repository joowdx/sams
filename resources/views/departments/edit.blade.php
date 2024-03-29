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
                {{ $department->name }}
            </div>

            <div class="card-body">
                <form method="post" action="{{ route('departments.update', $department->id) }}">
                    @csrf
                    @method('put')

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="new-name" placeholder="name"  value="{{ old('name') ?? $department->name }}">

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
                            <input id="shortname" type="text" class="form-control @error('shortname') is-invalid @enderror" name="shortname" required autocomplete="new-shortname" placeholder="shortname"  value="{{ old('shortname') ?? $department->shortname }}">

                            @error('shortname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="hexcolor" class="col-md-4 col-form-label text-md-right">Department Color</label>

                        <div class="col-md-6">
                            <input id="hexcolor" type="text" class="form-control @error('hexcolor') is-invalid @enderror" name="hexcolor" required onkeyup="this.value = this.value.toUpperCase();" autocomplete="new-hexcolor" placeholder="Input Hex"  value="{{ old('hexcolor') }}">

                            @error('hexcolor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="faculty_id" class="col-md-4 col-form-label text-md-right">Head</label>

                        <div class="col-md-6">
                            <select id="faculty_id" name="faculty_id" class="selectpicker" data-width="100%" data-live-search="true">
                                <option></option>
                                @foreach ($department->faculties as $faculty)
                                    <option value="{{ $faculty->id }}"}> {{ $faculty->name }} </option>
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
@endsection

@section('scripts')
<script>

</script>
@endsection
