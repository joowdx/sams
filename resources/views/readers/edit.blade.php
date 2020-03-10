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
                {{ $reader->name }}
            </div>

            <div class="card-body">
                <form method="post" action="{{ route('readers.update', $reader->id) }}" autocomplete="off">
                    @csrf
                    @method('put')

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required placeholder="name"  value="{{ old('name') ?? $reader->name }}">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ip" class="col-md-4 col-form-label text-md-right">IP</label>

                        <div class="col-md-6">
                            <input id="ip" type="text" class="form-control @error('ip') is-invalid @enderror" name="ip" required placeholder="IP"  value="{{ old('ip') ?? $reader->ip }}">

                            @error('ip')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="faculty_id" class="col-md-4 col-form-label text-md-right">Head</label>

                        <div class="col-md-6">
                            <select id="type" name="type" class="@error('type') is-invalid @enderror" data-width="100%" data-live-search="true" data-placeholder="Type">
                                <option></option>
                                <option value="room" {{ (old('type') ?? $reader->type) == 'room' ? 'selected' : '' }}> Room </option>
                                <option value="gate" {{ (old('type') ?? $reader->type) == 'gate' ? 'selected' : '' }}> Gate </option>
                            </select>
                            @error('type')
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
</div>
@endsection

@section('scripts')
<script>

</script>
@endsection
