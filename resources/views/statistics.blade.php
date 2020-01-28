@extends('layouts.app')

@section('content')
<div class="row">
    <canvas id="myChart" style="height: 230px; min-height: 230px; display: block; width: 572px;" width="715" height="287" class="chartjs-render-monitor"></canvas>
</div>
@endsection

@section('scripts')
<script>
async function getAbsent() {
    const attReq = await fetch('http://localhost:8000/api/records');
    const attData = await attReq.json();
    const clean = attData.data.map( data => ({
        remarks: data.remarks,
    })).filter(e => (e.remarks == 'abse'))

    console.log(clean);
}

async function getLate() {
    const attReq = await fetch('http://localhost:8000/api/records');
    const attData = await attReq.json();
    const clean = attData.data.map( data => ({
        remarks: data.remarks,
    }))

    console.log(clean);
}
getData();
</script>
@endsection
