@extends('layouts.app')
@section('styles')
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <table id="tblStudent" class="table table-striped table-bordered"  style="cursor:pointer;background-color:white;">
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
  var student = (function(){

    var
     
    $gridID = $("#tblStudent"),
    

     init = function(){
         
      $gridID.DataTable({
        'destroy': true,
        retrieve: true,
        columnDefs: [],
        "aaSorting": [],
       'ajax': {
            'url': '{{ url("/api/students")}}',
            'type': 'get',
            'dataSrc': e => e,
        },
        'columns': [
            {
                'title': 'uid',
                'data': 'uid',
            },
            {
                'title': 'name',
                'data': 'name',
            },
        ],
    });
    var table = $('#tblStudent').DataTable();
    $('#tblStudent tbody').on('click', 'tr', function () {
    
        var data = table.row( this ).data();
        console.log(data);
        //window.location.href="students/id=" + data.uid;
        window.location.href="students/"+data.id;
    } );



     };

     init();

  })();
</script>
@endsection
