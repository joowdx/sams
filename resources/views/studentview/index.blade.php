@extends('layouts.app')

@section('styles')
<style>


</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <table id="record" class="table table-bordered" style="cursor:pointer;">
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// $('#record').DataTable({
//     'destroy': true,
//     retrieve: true,
//     columnDefs: [],
//     "aaSorting": [],
//     'ajax': {
//         'url': '{{ url("/api/studentviews") }}',
//         'type': 'get',
//         'dataSrc': e => e[0].courses,
//     },
//     'columns': [
//         {
//             'title': 'name',
//             'data': 'code',
//         },
//         {
//             'title': 'Title',
//             'data': 'title',
//         },
//         {
//             'title': 'Description',
//             'data': 'description',
//         },
//         {
//             'title': 'Time',
//             'data': 'time_from',
//             fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
//             $(nTd).append(' - '+oData['time_to']);
//             }
//         },
//     ],
// });

// var table = $('#usertable').DataTable();
// $('#records tbody').on('click', 'tr', function () {
//     var data = table.row( this ).data();
//     window.location.href="users/" + data.id
// } );
</script>
@endsection
