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
.info-area {
    min-height: 500px;
}
.info-area .box_1620 {
    min-height: 400px;
    border-radius: 12px;
    position: relative;
    /* bottom: -200px; */
    background: #fff;
    padding: 30px;
    box-shadow: 0 20px 80px 0 rgba(153,153,153,.3);
}
.home_banner_area .banner_inner {
    min-height: 650px;
}
.banner_content{
    width: 100%;
}
.basic_info{
    margin-top: 50px;
}
 #stu-list {
    list-style-type: none;
	padding: 0;
	list-style: none;
    height: 15em;
}
.stu-icon{
    width:96px;
    height:90px;
    position: absolute;
    top: 20px;
    right: 15px;
    top: 15px;
}
.personal_text h1{
    font-weight: bold;
}
/* #stu-list > li:first-child {
    position: absolute;
    visibility: hidden;
    } */
#stu-img
{
    height: 313px;
    width: 374px;
}
</style>
@endsection

@section('content')
<div class="row">

    <div class="img-header">

        <img class="img-fluid" src="{{ asset('/assets/img/header1.png') }}" alt="">
    </div>

    <div class="col-md-12">
        <section class="info-area">
            <div class="container box_1620">
                <div class="banner_inner d-flex align-items-center">
                    <div class="banner_content">
                        <div class="media">
                            <div class="d-flex">
                                <div class="small-box text-center">
                                    @foreach ($logs as $log)
                                    <img id="stu-img" src="storage/avatars/no-image.png" alt="">
                                    <div class="inner bg-danger">
                                        <h1 id="nm1" class="font-weight-bold" style="">Donald McKinney</h1>
                                        <h4 id="crs1">Course: Junior UI, Status: ( ͡° ͜ʖ ͡°)</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="media-body">
                                <div class="personal_text">
                                    <div class="info text-center">
                                            <h1 id="">{{ Carbon\Carbon::parse($log->date)->format('d-m-Y') }}</h1>
                                        @endforeach
                                        <h1>UM Digos College</h1>
                                        <small>3361 Jose Abad Santos St, Digos City, 8002 Davao del Sur</small>
                                    </div>
                                    <ul class="list basic_info" id="stu-list">
                                        {{-- <li class="col-md-12 animated bounceInDown" id="li1">
                                            <div class="small-box">
                                                <div class="inner">
                                                    <h3 id="nm2">123</h3>
                                                <p id="crs2">123</p>
                                                </div>
                                                <div class="icon">
                                                    <img src="{{ asset('/assets/img/no-image.png') }}" alt="" class="stu-icon float-right">
                                                </div>
                                            </div>
                                        </li>
                                        <li class="col-md-12 animated bounceInDown" id="li1">
                                            <div class="small-box">
                                                <div class="inner">
                                                    <h3 id="nm2">123</h3>
                                                <p id="crs2">123</p>
                                                </div>
                                                <div class="icon">
                                                    <img src="{{ asset('/assets/img/no-image.png') }}" alt="" class="stu-icon float-right">
                                                </div>
                                            </div>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="img-footer">
        <img class="img-fluid" src="{{ asset('/assets/img/footer1.png') }}" alt="">
    </div>
</div>
@endsection

@section('scripts')
<script>
        // console.log(remarks)
        // console.log(name)

        // $('#nm1').text(name);
        // $("#crs1").text((course == null) ? 'None Specified':course);
$(e => {
    var queue = [];
    const gate = ({log_by : { name,avatar }, remarks, course}) => {

        $('#stu-img').attr('src',"storage/avatars/"+avatar);
        $("#nm1").text(name);
        $("#crs1").text( ( course== null) ? 'course: (uwu)' : 'course: '+course);
        $('#status').text('Status: ( ͡° ͜ʖ ͡°)');
        queue.forEach(function(e){
            $("#stu-list").prepend(
                `<li class="col-md-12 animated bounceInDown">
                    <div class="small-box">
                        <div class="inner">
                            <h3 id="nm2">`+e[0]+`</h3>
                        <p id="crs2">Course: `+((e[1] == null) ? '(uwu)' : e[1])+`, Status: ( ͡° ͜ʖ ͡°)</p>
                        </div>
                        <div class="icon">
                            <img src="storage/avatars/`+e[2]+`" alt="" class="stu-icon float-right">
                        </div>
                    </div>
                </li>`
            ).children().length < 3 || $('#stu-list').children().last().remove()
            queue.pop()
        })
        queue.push([name,course,avatar]);



    }
    Echo.private('logs').listen('NewScannedLog', e => gate(e.log))
})
</script>
@endsection
