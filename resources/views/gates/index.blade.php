@extends('layouts.app')

@section('styles')
<style>
div.remark
{
    height: 10em;
    position: relative;
}
div.remark h1
{
    margin: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%)
}
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="small-box text-center remark" id="remark-box" style="border-color:black;height:600px;">
            {{-- <img src="{{ asset('/assets/img/rfid.png') }}" id="imgs" class="img-fluid" alt="Responsive image" hidden> --}}
            <h1><i id="icon" class="remark fas fa-address-card" style="font-size:300px" hi></i></h1>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Information
            </div>
            <div class="card-body">
                <div class="col-md-12 col-sm-8">
                    <h1 id="name"></h1>
                    <h1 id="res"></h1>
                    <h1 id="cor"></h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(e => {
    const gate = ({log_by : { name }, remarks, course}) => {
        console.log(remarks)
        console.log(name)
        // remarks == 'entry' ? $('#remark-box').css("background-color","green") :  $('#remark-box').css("background-color","red")
        $('#icon').removeClass().addClass(remarks == 'entry' ? "far fa-thumbs-up fa-fw" : "far fa-portal-exit fa-fw")
        setTimeout(function(){$('#icon').addClass("fas fa-address-card"), $('#remark-box').css("background-color","white")},1500)
        // swal.fire({
        //     icon: 'error',
        //     title: 'Oops...',
        //     text: 'Something went wrong!',
        //     footer: '<a href>Why do I have this issue?</a>'
        // })
        $("#name").text("Name: "+name)
        $("#res").text(remarks == 'entry' ? "Action: ENTRY" : "Action: EXIT")
        $("#cor").text("Course: "+course)
    }
    Echo.private('logs').listen('NewScannedLog', e => gate(e.log))
})
</script>
@endsection
