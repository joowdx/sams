@extends('layouts.app')

@section('styles')

@endsection

@section('content')
@can('admin_view', App\User::class)
<form method="post" id="" action="{{ route('academicperiods.destroy', $period->id) }}">
    @csrf
    @method('delete')
    <div class="col-md-12">
        <button class="btn btn-danger" id="add" type="submit"><span class="fa fa-trash"></span></button>
    </div>
</form>
@endcan

<div class="container-fluid row justify-content-center">
    <div class="col-md-8">
        <div class="card card-dark">
            <div class="card-header">Update Academic Period</div>

            <div class="card-body">
                <form method="post" action="{{ route('academicperiods.update', $period->id) }}">
                    @csrf
                    @method('put')

                    <div class="form-group row">
                        <label for="school_year" class="col-md-4 col-form-label text-md-right">School Year</label>

                        <div class="col-md-6">
                            <input id="school_year" type="text" class="form-control @error('school_year') is-invalid @enderror" name="school_year" autocomplete="new-school_year" oninput="this.value=this.value.replace(/[^\d|^-]/,'')" placeholder="SCHOOL YEAR" value="{{ old('school_year') ?? $period->school_year }}">

                            @error('school_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="semester" class="col-md-4 col-form-label text-md-right">Semester</label>

                        <div class="col-md-6">
                            <select id="semester" name="semester" class="selectpicker form-control @error('semester') is-invalid @enderror" title="SEMESTER" data-width="100%">
                                <option value="1ST" {{ (old('semester') == '1ST' || $period->semester == '1ST') ? 'selected' : '' }}> 1ST </option>
                                <option value="2ND" {{ (old('semester') == '2ST' || $period->semester == '2ND') ? 'selected' : '' }}> 2ND </option>
                                <option value="SUMMER" {{ (old('semester') == 'SUMMER' || $period->semester == 'SUMMER') ? 'selected' : '' }}> SUMMER </option>
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
                            <select id="term" name="term" class="selectpicker form-control @error('term') is-invalid @enderror" title="TERM" data-width="100%">
                                <option value="1ST" {{ (old('term') == '1ST' || $period->term == '1ST') ? 'selected' : '' }}> 1ST </option>
                                <option value="2ND" {{ (old('term') == '2ND' || $period->term == '2ND') ? 'selected' : '' }}> 2ND </option>
                                <option value="SEMESTER" {{ (old('SEMESTER') == '1ST' || $period->term == 'SEMESTER') ? 'selected' : '' }}> SEMESTER </option>
                            </select>

                            @error('term')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="start" class="col-md-4 col-form-label text-md-right">Start</label>

                        <div class="col-md-6">
                            <input id="start" type="text" class="form-control @error('start') is-invalid @enderror" name="start" autocomplete="new-start" placeholder="SCHOOL YEAR" value="{{ old('start') ?? $period->start->format('d-m-Y') }}">

                            @error('start')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="end" class="col-md-4 col-form-label text-md-right">End</label>

                        <div class="col-md-6">
                            <input id="end" type="text" class="form-control @error('end') is-invalid @enderror" name="end" autocomplete="new-end" placeholder="SCHOOL YEAR" value="{{ old('end') ?? $period->end->format('d-m-Y') }}">

                            @error('end')
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

@endsection
