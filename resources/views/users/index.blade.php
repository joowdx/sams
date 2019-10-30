@extends('layouts.app')

@section('styles')
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

tr:hover {background-color:#D0D0D0;}

</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
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
        dom:    "<'row'<'col-sm-12 col-md-8'l>B<'col-sm-12 col-md-2'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        columnDefs: [],
        "aaSorting": [],
        buttons: [
        {
            text: 'Add',
            action: e => window.location.href="{{ route('users.create') }}",
        },
            'copy','csv', 'excel', 'print'
        ],
       'ajax': {
            'url': '{{ url("/api/users") }}',
            'type': 'get',
            'dataSrc': e => e,
        },
        // 'dataSrc': e => e.data,
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
    // console.log(data)
    window.location.href="users/" + data.id
} );

</script>
@endsection
