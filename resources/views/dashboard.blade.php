@extends('layouts.app')

@section('content')
<div class="container-fluid">
</div>
@endsection

@section('scripts')
<script>
    try {
        Echo.private('logs').listen('NewScannedLog', function(e) {
            notify({
                'icon': 'fad fa-info-circle fa-fw mr-2',
                'message': `${e.log.log_by.school_id} ⁠— ${e.log.log_by.name} in ${e.log.from} at ${new Date(e.log.created_at).toLocaleString('en-gb', {hour12: false, hour: '2-digit', minute: '2-digit', second: '2-digit'})}`,
            })
        })
    } catch (error) {
        // location.reload()
    }
</script>
@endsection
