@extends('layouts.app')

@section('styles')
<style>

</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('courses.create') }}" id="add" class="btn"><span class="fa fa-plus"></a>
        </div>
        <div class="col-md-12">
            <table id="coursesteable" class="table table-bordered" style="cursor:pointer;"></table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$('#coursesteable').DataTable({
    'destroy': true,
        retrieve: true,
        columnDefs: [],
        "aaSorting": [],
        'ajax': {
            'url': '{{ url("/api/courses") }}',
            'type': 'get',
            'dataSrc': e => e,
        },
        'columns': [
        {
            'title': 'Code',
            'data': 'code',
        },
        {
            'title': 'Title',
            'data': 'title',
        },
        {
            'title': 'Description',
            'data': 'description',
        },
        {
            'title': 'Time',
            'data': 'time_from',
            fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
            $(nTd).append(' - '+oData['time_to']);
        }
        },
        ],
});

var table = $('#coursesteable').DataTable();
$('#coursesteable tbody').on('click', 'tr', function () {
    var data = table.row( this ).data();
    window.location.href="courses/" + data.id
} );
</script>
@endsection
