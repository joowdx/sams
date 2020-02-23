@extends('layouts.app')

@section('styles')
<style>
    .cls-1 {
        fill: red;
        fill-rule: evenodd;
    }

    .cls-2, .cls-3 {
        font-size: 25px;
    }

    .cls-2, .cls-3, .cls-4 {
        fill: #240203;
        font-family: Tahoma;
    }

    .cls-2, .cls-4 {
        text-anchor: middle;
    }

    .cls-4 {
        font-size: 30px;
        font-weight: 700;
    }
</style>
<script src=""></script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <div class="card direct-chat direct-chat-primary" style="position: relative; left: 0px; top: 0px;">
                <div class="card-header pb-1">
                    <h3 class="card-title">Recent logs</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages">
                        <!-- Message. Default to the left -->

                        @foreach ($logs as $log)
                        {{-- <div class="media text-muted pt-3">
                            <img data-src="{{ asset('storage/umdc.png') }}" alt="" class="mr-2 rounded">
                            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                <span class="float-right badge badge-{{ $log->remarks=='ok'?'success':'danger' }}"> {{ $log->remarks }} </span>
                                <strong class="d-block text-gray-dark">
                                    {{ $log->log_by->uid }} ⁠— {{ $log->log_by->name }}
                                </strong>
                                <strong>{{ $log->from_by->name }}</strong> at {{ $log->created_at->format('H:i:s') }}
                            </p>
                        </div> --}}
                        <div class="direct-chat-msg">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-left">
                                    {{  $log->log_by->name }}
                                    <small> {{ "@".@$log->from_by->name }}</small>
                                </span>
                                <span class="direct-chat-timestamp float-right">{{  $log->created_at ? $log->created_at->diffForHumans() : ''  }}</span>
                            </div>
                            <!-- /.direct-chat-infos -->
                            {{-- <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt=""> --}}
                            <!-- /.direct-chat-img -->
                            {{-- <div class="direct-chat-text">
                                @ {{ $log->from_by->name }}
                            </div> --}}
                            <!-- /.direct-chat-text -->
                        </div>
                        @endforeach
                        {{-- <div class="direct-chat-msg">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-left">Alexander Pierce</span>
                                <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                            </div>
                            <!-- /.direct-chat-infos -->
                            <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="">
                            <!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                Is this template really for free? That's unbelievable!
                            </div>
                            <!-- /.direct-chat-text -->
                        </div> --}}
                        <!-- /.direct-chat-msg -->

                        <!-- Message to the right -->
                        {{-- <div class="direct-chat-msg right">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-right">Sarah Bullock</span>
                                <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                            </div>
                            <!-- /.direct-chat-infos -->
                            <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="">
                            <!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                You better believe it!
                            </div>
                            <!-- /.direct-chat-text -->
                        </div> --}}
                        <!-- /.direct-chat-msg -->
                    </div>
                    <!--/.direct-chat-messages-->

                    <!-- Contacts are loaded here -->
                    <div class="direct-chat-contacts">
                        <ul class="contacts-list">
                            <li>
                                <a href="#">
                                    {{-- <img class="contacts-list-img" src="dist/img/user1-128x128.jpg"> --}}

                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            Count Dracula
                                            <small class="contacts-list-date float-right">2/28/2015</small>
                                        </span>
                                        <span class="contacts-list-msg">How have you been? I was...</span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                            <li>
                                <a href="#">
                                    {{-- <img class="contacts-list-img" src="dist/img/user7-128x128.jpg"> --}}

                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            Sarah Doe
                                            <small class="contacts-list-date float-right">2/23/2015</small>
                                        </span>
                                        <span class="contacts-list-msg">I will be waiting for...</span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                            <li>
                                <a href="#">
                                    {{-- <img class="contacts-list-img" src="dist/img/user3-128x128.jpg"> --}}

                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            Nadia Jolie
                                            <small class="contacts-list-date float-right">2/20/2015</small>
                                        </span>
                                        <span class="contacts-list-msg">I'll call you back at...</span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                            <li>
                                <a href="#">
                                    {{-- <img class="contacts-list-img" src="dist/img/user5-128x128.jpg"> --}}

                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            Nora S. Vans
                                            <small class="contacts-list-date float-right">2/10/2015</small>
                                        </span>
                                        <span class="contacts-list-msg">Where is your new...</span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                            <li>
                                <a href="#">
                                    {{-- <img class="contacts-list-img" src="dist/img/user6-128x128.jpg"> --}}

                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            John K.
                                            <small class="contacts-list-date float-right">1/27/2015</small>
                                        </span>
                                        <span class="contacts-list-msg">Can I take a look at...</span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                            <li>
                                <a href="#">
                                    {{-- <img class="contacts-list-img" src="dist/img/user8-128x128.jpg"> --}}

                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            Kenneth M.
                                            <small class="contacts-list-date float-right">1/4/2015</small>
                                        </span>
                                        <span class="contacts-list-msg">Never mind I found...</span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                        </ul>
                        <!-- /.contacts-list -->
                    </div>
                    <!-- /.direct-chat-pane -->
                </div>
                <!-- /.card-body -->
                <!-- /.card-footer-->
            </div>
        </div>




        <div class="col-md-8">
            <div class="card">
                <div class="card-header pb-1">
                    <h3 class="card-title">Stats</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="d-md-flex">
                        <canvas id="myChart" style="position: relative; height:400px; width:400px" class="chartjs-render-monitor"></canvas>
                    </div><!-- /.d-md-flex -->
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    {{-- <div class="col-lg-4 col-sm-6">
        <div class="my-3 p-3 bg-white rounded box-shadow" id="logslist">
            <h6 class="border-bottom border-gray pb-2 mb-0">Recent logs</h6>
            <div id="logs">
                @foreach ($logs as $log)
                <div class="media text-muted pt-3">
                    <img data-src="{{ asset('storage/umdc.png') }}" alt="" class="mr-2 rounded">
                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                        <span class="float-right badge badge-{{ $log->remarks=='ok'?'success':'danger' }}"> {{ $log->remarks }} </span>
                        <strong class="d-block text-gray-dark">
                            {{ $log->log_by->uid }} ⁠— {{ $log->log_by->name }}
                        </strong>
                        <strong>{{ $log->from_by->name }}</strong> at {{ $log->created_at->format('H:i:s') }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </div> --}}
</div>
@endsection

@section('scripts')
<script>
    try {
        Echo.private('logs').listen('NewScannedLog', e => {
            try {
                $('#logs').children().length < 10 || $('#logs').children().last().remove()
                $('#logs').prepend(
                `
                <div class="media text-muted pt-3 animated fadeIn">
                    <img data-src="{{ asset('storage/umdc.png') }}" alt="" class="mr-2 rounded">
                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                        <span class="float-right badge badge-${e.log.remarks=='ok'?'success':'danger'}"> ${e.log.remarks} </span>
                        <strong class="d-block text-gray-dark">
                            ${e.log.log_by.uid} ⁠— ${e.log.log_by.name}
                        </strong>
                        <strong>${e.log.from_by.name}</strong> at
                        ${
                            new Date(e.log.created_at).toLocaleString('en-gb',
                            {
                                hour12: false,
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit'
                            }
                            )
                        }
                    </p>
                </div>
                `
                );
                // notify({
                    //     'icon': 'fad fa-info-circle fa-fw mr-2',
                    //     'message': `${e.log.log_by.uid} ⁠— ${e.log.log_by.name} in ${e.log.from} at ${new Date(e.log.created_at).toLocaleString('en-gb', {hour12: false, hour: '2-digit', minute: '2-digit', second: '2-digit'})}

                    //     ${$('#logs').children().length}
                    //     `,
                    // })
                    console.log(e)
                } catch(error) {

                }

            })
            .listen('UnknownTag', e => {
                console.log(e)
            })
        } catch (error) {
            console.log(e)
            // location.reload()
        }

async function getData() {

    const attReq    = await fetch('http://localhost:8000/api/records');
    const attData   = await attReq.json();
    const clean     = attData.map(data => ({
        days: moment(data.time).format('MMM YYYY'),
        remarks: data.remarks,
    }))

    var data = clean,
    grouped = function (array) {
        var r = [];
        array.forEach(function(a) {
            if(!this[a.days]){
                this[a.days] = {days: a.days, late: 0, absent: 0};
                r.push(this[a.days]);
            }
            this[a.days][a.remarks]++;
        },Object.create(null));
        return r;
    }(data);

    return grouped;

}


$(document).ready( async function(){

    const data = await getData();

    const days = data.map(function(e){
        return e.days;
    })

    const late = data.map(function(e){
        return e.late;
    })

    const absent = data.map(function(e){
        return e.absent;
    })

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: days,
            datasets: [{
                label: 'Lates',
                data: late,
                borderWidth: 3,
                backgroundColor: '#f39c12',
                order: 1
            }, {
                label: 'Absences',
                data: absent,
                borderWidth: 3,
                backgroundColor: '#f56954',
                order: 2
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },

                }]
            },
        }
    });
})
    </script>
    @endsection
