@extends('layouts.app')

@section('styles')
<style>
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('users.create') }}" id="add" class="btn btn-primary"><span class="fa fa-plus"></span></a>
        </div>
        <div class="col-md-12">
            <table id="usertable" class="table table-bordered" style="cursor:pointer;">
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$('#usertable').DataTable({
        'destroy': true,
        retrieve: true,
        columnDefs: [],
        "aaSorting": [],
       'ajax': {
            'url': '{{ url("/api/users") }}',
            'type': 'get',
            'dataSrc': e => e,
        },
        'columns': [
            {
                'title': 'Name',
                'data': 'name',
            },
            {
                'title': 'Email',
                'data': 'email',
            },
            {
                'title': 'Username',
                'data': 'username',
                'render': d => `@${d}`
            },
            {
                'title': 'Type',
                'data': 'type',
                'render': d => ucwords(d)
            },
        ],
    });

var table = $('#usertable').DataTable();
$('#usertable tbody').on('click', 'tr', function () {
    var data = table.row( this ).data();
    window.location.href="users/" + data.id
} );

</script>
@endsection
