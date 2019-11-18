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
                <a href="{{ route('students.index') }}" id="add" class="btn btn-custom"><span class="fa fa-arrow-left"></span></a>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Student') }}</div>

                    <div class="card-body">
                        <form method="POST" id="createform" action="{{ route('students.store') }}">
                            @include('students.forms')

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" id="btnsave" style="float:right;">
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

@endsection
