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
<section class="content">

    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row d-flex align-items-stretch">
                @foreach($faculties as $faculty)
                <div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch">
                    <a href="{{ route('faculties.show', $faculty->id) }}" class="list-group-item-action">
                        <div class="card bg-light">
                            <div class="card-header text-muted border-bottom-0">
                                #{{ $faculty->uid }}
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b>{{ $faculty->name }}</b></h2>
                                        <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        <img src="../../dist/img/user1-128x128.jpg" alt="" class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <!-- /.card-body -->
        <div class="d-flex justify-content-center">
            {{ $faculties->links() }}
        </div>
    </div>
    <!-- /.card -->
</section>
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
