@extends('layouts.app')

@section('styles')

@endsection

@section('content')
{{ $errors }}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-dark">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <br>
                    <form method="post" action="{{ route('faculties.store') }}">z
                        @csrf
                        <div class="form-group row">
                            <label for="uid" class="col-md-4 col-form-label text-md-right">{{ __('UID') }}</label>

                            <div class="col-md-6">
                                <input id="uid" type="text" class="form-control @error('uid') is-invalid @enderror" name="uid" required autocomplete="new-uid" oninput="this.value=this.value.replace(/[^\d]/,'')" name="uid">

                                @error('uid')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="new-name" name="name">

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
