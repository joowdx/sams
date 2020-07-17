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
                Edit {{ $event->title }}
            </div>

            <div class="card-body">
                <form method="post" action="{{ url('events/'.$event->id) }}" autocomplete="off">

                    @csrf
                    @method('put')

                    <div class="form-group row">
                        <label for="start" class="col-md-4 col-form-label text-md-right">Start</label>

                        <div class="col-md-6">
                            <input id="start" type="text" class="form-control @error('start') is-invalid @enderror" name="start" required autocomplete="new-start" placeholder="Format: dd/mm/yyyy"  value="{{ old('start') ?? $event->start->format('d/m/Y') }}">
                        </div>
                        @error('start')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="end" class="col-md-4 col-form-label text-md-right">End</label>

                        <div class="col-md-6">
                            <input id="end" type="text" class="form-control @error('end') is-invalid @enderror" name="end" required autocomplete="new-end" placeholder="Format: dd/mm/yyyy"  value="{{ old('end') ?? $event->end->format('d/m/Y') }}">
                            @error('end')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Title"  value="{{ old('title') ?? $event->title }}">

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
                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description"  value="{{ old('description') ?? $event->description }}">

                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="remarks" class="col-md-4 col-form-label text-md-right">Remarks</label>

                        <div class="col-md-6">
                            <select id="remarks" name="remarks" data-width="100%">
                                <option value="national holiday" @if(old('remarks') == 'national holiday' || $event->remarks == 'national holiday') selected @endif> National Holiday </option>
                                <option value="local holiday" @if(old('remarks') == 'local holiday' || $event->remarks == 'local holiday') selected @endif> Local Holiday </option>
                                <option value="institutional event" @if(old('remarks') == 'institutional event' || $event->remarks == 'institutional event') selected @endif> Institutional Event </option>
                                <option value="class suspension" @if(old('remarks') == 'class suspension' || $event->remarks == 'class suspension') selected @endif> Class Suspension </option>
                                <option value="break" @if(old('remarks') == 'break' || $event->remarks == 'break') selected @endif> Break </option>
                                <option value="info" @if(old('remarks') == 'info' || $event->remarks == 'info') selected @endif> Info </option>
                            </select>
                            @error('remarks')
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
