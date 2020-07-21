@extends('layouts.app')

@section('styles')
<style>
#add {
  position: fixed; /* Fixed/sticky position */
  bottom: 20px; /* Place the button at the bottom of the page */
  right: 30px; /* Place the button 30px from the right */
  z-index: 99; /* Make sure it does not overlap */
  border: none; /* Remove borders */
  outline: none; /* Remove outline */
  color: white; /* Text color */
  cursor: pointer; /* Add a mouse pointer on hover */
  width: 50px;
  height: 50px;
  border-radius: 50%;
  line-height: 40px;
  text-align: center;
  font-size: 18px; /* Increase font size */
}

#add:hover {
  background-color: #555; /* Add a dark-grey background on hover */
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">
            <a href="{{ route('faculties.index') }}" id="add" class="btn btn-custom"><span class="fa fa-arrow-left"></span></a>
        </div>

        <div class="col-md-8">
            <div class="card card-dark">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <br>
                    <form method="post" action="{{ route('faculties.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="uid" class="col-md-4 col-form-label text-md-right">{{ __('UID') }}</label>

                            <div class="col-md-6">
                                <input id="uid" type="text" class="form-control @error('uid') is-invalid @enderror" name="uid" autocomplete="new-uid" oninput="this.value=this.value.replace(/[^\d]/,'')" name="uid">

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

                        <div class="form-group row">
                            <label for="faculty_id" class="col-md-4 col-form-label text-md-right">Program</label>
                            <div class="col-md-6">
                                <select id="program_id" name="program_id" data-width="100%" data-live-search="true" data-placeholder="Program">
                                    <option></option>
                                    @foreach ($programs as $program)
                                        <option value="{{ $program->id }}" {{ @$student->program->id == $program->id ? 'selected' : '' }}> {{  $program->shortname }} </option>
                                    @endforeach
                                </select>
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
