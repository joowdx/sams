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

        <div class="col-md-6">
            <div class="card">
                <div class="card-header pb-1">
                    <div class="row m-0 p-0">
                        <div class="col d-flex m-0 p-0">
                            <h3 class="card-title pt-2">Faculties</h3>
                        </div>
                        <div class="col d-flex flex-row-reverse m-0 p-0">
                            <div class="col m-0 p-0 pl-2 ml-1">
                                <select id="showby" class="selectpicker form-control" title="Show by" data-width="100%">
                                    <option value="department"> Department </option>
                                    <option value="program"> Program </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="d-md-flex">
                        <canvas id="stats" style="position: relative; height:400px; width:400px" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header pb-1">
                    <div class="row m-0 p-0">
                        <div class="col d-flex m-0 p-0">
                            <h3 class="card-title pt-2">Population</h3>
                        </div>
                        <div class="col d-flex flex-row-reverse m-0 p-0">
                            <div class="col m-0 p-0 pl-2 ml-1">
                                <select id="showbypop" class="selectpicker form-control" title="Show by" data-width="100%">
                                    <option value="department"> Department </option>
                                    <option value="program"> Program </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="d-md-flex">
                        <canvas id="population" style="position: relative; height:400px; width:400px" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="col-md-8">
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
        </div> --}}
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

    const attReq    = await fetch('{{ url('api/records') }}');
    const attData   = await attReq.json();
    console.log(attData)
    const clean     = attData.map(data => ({
        days: moment(data.date).format('MMM YYYY'),
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
    $('#showby').on('select2:select', async function (e) {
        await fetch('{{ url('api/statistics') }}' + '?level=' + this.value).then(e => e.json()).then(async e => {
            try { await window.statschart.destroy() } catch(_x) { }
            window.statschart = new Chart($('#stats')[0], {
                type: 'bar',
                data: e,
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        xAxes: [{
                            gridLines: {
                                offsetGridLines: false
                            }
                        }],
                        yAxes: [
                            {
                                ticks: {
                                    precision: 0,
                                    beginAtZero: true,
                                },
                            },
                        ],
                    }
                }
            })
        })
    })
    $('#showby').trigger('select2:select')
    $('#showbypop').on('select2:select', async function(e) {
        await fetch('{{ url('api/population') }}' + '?level=' + this.value).then(e => e.json()).then(async e => {
            try { await window.popchart.destroy() } catch(_x) { }
            window.popchart = new Chart($('#population')[0], {
                type: 'bar',
                data: e,
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        xAxes: [{
                            gridLines: {
                                offsetGridLines: false
                            }
                        }],
                        yAxes: [
                            {
                                ticks: {
                                    precision: 0,
                                    beginAtZero: true,
                                },
                            },
                        ],
                    }
                }
            })
        })
    })
    $('#showbypop').trigger('select2:select')

    // const data = await getData();

    // const days = data.map(function(e){
    //     return e.days;
    // })

    // const late = data.map(function(e){
    //     return e.late;
    // })

    // const absent = data.map(function(e){
    //     return e.absent;
    // })

    // var ctx = document.getElementById('myChart').getContext('2d');
    // var myChart = new Chart(ctx, {
    //     type: 'line',
    //     data: {
    //         labels: days,
    //         datasets: [{
    //             label: 'Lates',
    //             data: late,
    //             borderWidth: 3,
    //             backgroundColor: '#f39c12',
    //             order: 1
    //         }, {
    //             label: 'Absences',
    //             data: absent,
    //             borderWidth: 3,
    //             backgroundColor: '#f56954',
    //             order: 2
    //         }]
    //     },
    //     options: {
    //         maintainAspectRatio: false,
    //         scales: {
    //             yAxes: [{
    //                 ticks: {
    //                     beginAtZero: true
    //                 },

    //             }]
    //         },
    //     }
    // });
})
</script>
@endsection
