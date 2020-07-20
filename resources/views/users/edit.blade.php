@extends('layouts.app')

@section('styles')

@endsection
@section('content')
@can('admin_view', App\User::class)
<form method="post" id="" action="{{ route('users.destroy', $user->id) }}">
    @csrf
    @method('delete')
    <div class="col-md-12">
        <button class="btn btn-danger" id="add" type="submit"><span class="fa fa-trash"></span></button>
    </div>
</form>
@endcan
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Details for {{ $user->name }}</div>

                    <div class="card-body">
                        <form method="POST" action="/users/{{ $user->id }}" enctype="multipart/form-data" >
                        @method('PATCH')
                        @csrf
                            @include('users.forms')
                            <hr>
                            <div class="form-group row">
                                <div class="col-md-12 text-center">
                                    <small class="text-center" style="color:red">LEAVE PORTION BELOW UNLESS YOU WANT CHANGES</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="faculty_id" class="col-md-4 col-form-label text-md-right">Faculty</label>

                                <div class="col-md-6">
                                    <select id="faculty_id" name="faculty_id" class="@error('faculty_id') @enderror" data-width="100%" data-live-search="true" data-placeholder="">
                                        <option></option>
                                        @foreach ($faculties as $faculty)
                                            <option value="{{ $faculty->id }}" {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}> {{ $faculty->name }} </option>
                                        @endforeach
                                    </select>
                                    @error('faculty_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                                <div class="col-md-6 text-center">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" style="float:right;">
                                        {{ __('Save') }}
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
<script>

</script>
@endsection
