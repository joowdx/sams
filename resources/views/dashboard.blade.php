@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-lg-4 col-sm-6">
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
            <small class="d-block text-right mt-3">
                <a href="#">All updates</a>
            </small>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    try {
        Echo.private('logs').listen('NewScannedLog', function(e) {
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
    } catch (error) {
        // location.reload()
    }
</script>
@endsection
