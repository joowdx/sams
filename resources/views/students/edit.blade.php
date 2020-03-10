@extends('layouts.app')

@section('styles')
<style>

</style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ $student->name }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('students.update', $student->id) }} " enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    @include('students.forms')

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-dark float-right">
                                {{ __('Save') }}
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
