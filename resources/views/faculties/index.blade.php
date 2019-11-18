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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('faculties.create') }}" id="add" class="btn btn-custom"><span class="fa fa-plus"></a>
        </div>
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
