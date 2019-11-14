@extends('layouts.app')

@section('styles')
<style>

</style>
@endsection

@section('content')
<div class="container-fluid">
    <a href="{{ route('faculties.create') }}" class="nav-link"> Create new </a>
    <div class="row">
        <div class="col-md-12">
            <table id="facultytable" class="table table-bordered" style="cursor:pointer;">
            </table>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
    $('#facultytable').DataTable({
        'destroy': true,
        retrieve: true,
        columnDefs: [],
        "aaSorting": [],
        'ajax': {
            'url': '{{ url("/api/faculties") }}',
            'type': 'get',
            'dataSrc': e => e,
        },
        'columns': [
        {
            'title': 'UID',
            'data': 'uid',
        },
        {
            'title': 'Name',
            'data': 'name',
        },
        ],
    });

    var table = $('#facultytable').DataTable();
    $('#facultytable tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        window.location.href="faculties/" + data.id
    } );
</script>
@endsection
