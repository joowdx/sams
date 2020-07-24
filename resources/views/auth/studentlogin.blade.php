@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Student Auth') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('x') }}">
                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('School ID') }}</label>

                            <div class="col-md-6">
                                <input id="id" type="id" class="form-control @if(session('error')) is-invalid @endif" name="id" required autocomplete="current-id">

                                @if(session('error'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ session('error') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
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
$(() => {

    $('form').on('submit', function(e) {
        console.log($('#id').val())
        location.href = `${this.action}/${$('#id').val()}`

        e.preventDefault()
    })

})
</script>
@endsection
