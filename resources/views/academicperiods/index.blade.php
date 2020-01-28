@extends('layouts.app')

@section('styles')
<style>

</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('academicperiods.create') }}" id="add" class="btn"><span class="fa fa-plus"></a>
        </div>
        <div class="col-md-12">
            <table id="aptable" class="table table-bordered" style="cursor:pointer;"></table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$('#aptable').DataTable({
    'destroy': true,
        retrieve: true,
        columnDefs: [],
        "aaSorting": [],
        'ajax': {
            'url': '{{ url("/api/academicperiods") }}',
            'type': 'get',
            'dataSrc': e => e,
        },
        'columns': [
        {
            'title': 'School Year',
            'data': 'school_year',
        },
        {
            'title': 'Semester',
            'data': 'semester',
        },
        {
            'title': 'Term',
            'data': 'term',
        },
        {
            'title': 'Start - End dates',
            'data': 'start',
            fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
            $(nTd).append(' - '+oData['end']);
        }
        },
        ],
});

var table = $('#aptable').DataTable();
$('#aptable tbody').on('click', 'tr', function () {
    var data = table.row( this ).data();
    window.location.href="academicperiods/" + data.id
} );
</script>
@endsection
