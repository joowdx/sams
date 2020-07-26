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
                New Department
            </div>

            <div class="card-body">
                <form method="post" action="{{ route('departments.store') }}">
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
