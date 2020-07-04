@extends('layouts.app')

@section('styles')
<style>
div.remark
{
    height: 10em;
    position: relative;
}
.small-box > .inners {
    padding: 10px;
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
 #stu-list-entry {
    list-style-type: none;
	padding: 0;
	list-style: none;
}

#stu-list-exit {
    list-style-type: none;
	padding: 0;
	list-style: none;
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
    height: 420px;
    width: 100%;
}
.student-card{
border-radius: 0;
height: 100%;
}
</style>
@endsection

@section('content')
<div class="row justify-content-md-center" style="background-color: #181a1b !important; padding: 10px; height:140px">
    <div class="col col-md-auto">
        <img class="img-fluid" src="{{ asset('/assets/img/umdc.png') }}" style="height: 120px;">
    </div>

    <div class="col col-md-auto">
        <h1 class="font-weight-bold text-white" style="font-size: 72px;">UM Digos College</h1>
        <small class="text-white" style="float: right;">3361 Jose Abad Santos St, Digos City, 8002 Davao del Sur</small>
    </div>
</div>

<div class="row">

    <div class="col col-md-5" style=" padding:0;">
        <div class="card student-card">
            <img class="card-img-top" id="stu-img" src="storage/avatars/no-image.png" alt="Card image cap">
            <div class="card-body text-center inners" style="background-color: #3b3a30">
                <h1 class="font-weight-bold text-white" id="stu-name">Name:</h1>
                <small class="text-white" id="stu-course"></small>
            </div>
        </div>
    </div>

    <div class="col col-md-7">
        <ul class="list basic_info mt-3" id="stu-list-entry" style="width: 100%;">
            <li class="col-md-12 animated bounceInDown" id="li1">
                <div class="small-box">
                    <div class="inner">
                        <h3 id="nm2">/</h3>
                    <p id="crs2">/</p>
                    </div>
                    <div class="icon">
                        <img src="{{ asset('/assets/img/no-image.png') }}" alt="" class="stu-icon float-right">
                    </div>
                </div>
            </li>
        </ul>
    </div>

</div>
        {{-- <img class="img-fluid" src="{{ asset('/assets/img/header1.png') }}" alt=""> --}}


{{--<div class="col-md-12">
        <section class="info-area">
            <div class="container box_1620">
                <div class="banner_inner d-flex align-items-center">
                    <div class="banner_content">
                        <div class="media">
                            <div class="d-flex">
                                <div class="small-box text-center">
                                    <img id="stu-img" src="storage/avatars/no-image.png" alt="">
                                    <div class="inners">
                                        <h1 id="nm1" class="font-weight-bold" style="">Donald McKinney</h1>
                                        <h4 id="crs1">Course: Junior UI, Status: ( ͡° ͜ʖ ͡°)</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="media-body">
                                <div class="personal_text">
                                    <ul class="list basic_info mt-0" id="stu-list-entry">
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
                                        </li>
                                    </ul>
                                    <ul class="list basic_info mt-0" id="stu-list-exit">
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
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div> --}}


<div class="row align-items-center justify-content-md-center" style="background-color: #181a1b !important;  padding: 10px; height:100px">
    @foreach ($logs as $log)
        <h1 class="text-white" id="">{{ Carbon\Carbon::parse($log->date)->format('d-m-Y') }}</h1>
    @endforeach
</div>
@endsection

@section('scripts')
<script>
$(e => {
    var queue = [];
    const gate = ({log_by : { name,avatar }, remarks, course}) => {

        $('#stu-img').attr('src',"storage/avatars/"+avatar);
        $("#stu-name").text(name);
        $(".inners").addClass((remarks == 'entry') ? 'inners bg-success' : 'inners bg-warning');
        $("#stu-course").text(( course == null) ? '/' : ''+course);
        if(remarks == "entry"){
        queue.forEach(function(e){
            $("#stu-list-entry").prepend(
                `<li class="col-md-12 animated bounceInDown">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 id="nm2">`+e[0]+`</h3>
                        <p id="crs2">Course: `+((e[1] == null) ? '/' : e[1])+`</p>
                        </div>
                        <div class="icon">
                            <img src="storage/avatars/`+e[2]+`" alt="" class="stu-icon float-right">
                        </div>
                    </div>
                </li>`
            ).children().length < 3 || $('#stu-list-entry').children().last().remove()
            queue.pop()
        })
        queue.push([name,course,avatar]);
        } else if (remarks == "exit") {
            queue.forEach(function(e){
            $("#stu-list-exit").prepend(
                `<li class="col-md-12 animated bounceInDown">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3 id="nm2">`+e[0]+`</h3>
                        <p id="crs2">Course: `+((e[1] == null) ? '(uwu)' : e[1])+`, Status: ( ͡° ͜ʖ ͡°)</p>
                        </div>
                        <div class="icon">
                            <img src="storage/avatars/`+e[2]+`" alt="" class="stu-icon float-right">
                        </div>
                    </div>
                </li>`
            ).children().length < 3 || $('#stu-list-exit').children().last().remove()
            queue.pop()
        })
        queue.push([name,course,avatar]);
        }

    }
    Echo.private('logs').listen('NewScannedLog', e =>{
        ((e.log.reader.name == "G1") ? gate(e.log) : '')
    })
})
</script>
@endsection
