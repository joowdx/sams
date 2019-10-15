@extends('layouts.app')

@section('styles')
<style>

</style>
@endsection

@section('content')
@endsection

@section('scripts')
<script>
    Echo.private('logs').listen('NewLog', e => {
        alertify.error(e);
    })
</script>
@endsection
