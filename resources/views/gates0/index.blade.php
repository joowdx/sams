@extends('layouts.standalone')

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
/* #stu-list-entry > li:first-child {
    position: absolute;
    visibility: hidden;
}

#stu-list-exit > li:first-child {
    position: absolute;
    visibility: hidden;
} */
#stu-img
{
    height: 500px;
    width: 100%;
}
.student-card{
border-radius: 0;
height: 100%;
}
</style>
@endsection

@section('security_content')
<div class="row justify-content-md-center" style="background-color: #181a1b !important; padding: 10px; height:140px">

    <div class="col col-md-auto">
        <img class="img-fluid" src="{{ asset('/assets/img/umdc.png') }}" style="height: 120px;">
    </div>

    <div class="col col-md-auto">
        <h1 class="font-weight-bold text-white" style="font-size: 72px;">UM Digos College</h1>
        <small class="text-white" style="float: right;">3361 Jose Abad Santos St, Digos City, 8002 Davao del Sur</small>
    </div>


    <div class="col col-md-auto">
        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
            <span><i class="fas fa-scroll"></i></span>
        </button>
    </div>

</div>


<div class="row" style="background-color: #666666">

    <div class="col col-md-5" style=" padding:0;">
        <div class="card student-card">
            <img class="card-img-top" id="stu-img" src="storage/avatars/no-image.png" alt="Card image cap">
            <div class="card-body text-center inners" style="background-color: #666666">
                <h1 class="font-weight-bold text-white" id="stu-name">Name:</h1>
                <small class="text-white" id="stu-course">/</small>
            </div>
        </div>
    </div>




    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Log</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12" style="width:100%; height: 500px; overflow: auto">
                    <table class="table no-datatable" id="log">
                    <thead>
                        <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Remark</th>
                        <th scope="col">Date</th>
                        </tr>
                    </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>


    <div class="col col-md-7">
        <h1 class="text-white">ENTRY</h1>
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
        <h1 class="text-white">EXIT</h1>
        <ul class="list basic_info mt-3" id="stu-list-exit" style="width: 100%;">
            <li class="col-md-12 animated bounceInDown" id="li2">
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

    <div class="col col-md-auto" style="">
        <h1 class="text-white" style="font-size: 72px;">G1</h1>
    </div>

    <div class="col col-md-auto">
        {{-- @foreach ($logs as $log)
            <h1 class="text-white" id="">{{ Carbon\Carbon::parse($log->date)->format('d-m-Y') }}</h1>
        @endforeach --}}
    </div>

</div>
@endsection

@section('scripts')
<script>
$(e => {
    var queue = [];

    const gate = ({log_by : { name, avatar, enrolled }, remarks, course, date}) => {

        $('#stu-img').attr('src',"storage/avatars/"+avatar);
        $("#stu-name").text(name).append($('<small></small>').append($('<span></span>').addClass('badge float-right badge-' + (enrolled ? 'success' : 'warning')).html(enrolled ? 'enrolled' : 'not enrolled')));
        $(".inners").removeClass().addClass((remarks == 'entry') ? 'card-body text-center inners bg-success' : 'card-body text-center inners bg-danger');
        $("#stu-course").text(( course == null) ? '/' : ''+course);


        queue.forEach(function(e){
        $('#log').prepend(
            `<tbody>
                <tr>
                    <td>`+e[0]+`</td>
                    <td>`+e[4]+`</td>
                    <td>`+e[3]+`</td>
                </tr>
            </tbody>`
        )});

        queue.forEach(function(e){
            if(e[3] == 'entry'){
                $("#stu-list-entry").prepend(
                    `<li class="col-md-12 animated bounceInDown">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3 id="nm2">` + e[0] + `
                                    <small><span class="float-right badge badge-${ e[5] ? 'success' : 'warning'}"> ${ e[5] ? 'enrolled' : 'not enrolled'} </span> </small>
                                </h3>
                            <p id="crs2">Course: `+((e[1] == null) ? '/' : e[1])+`</p>
                            </div>
                            <div class="icon">
                                <img src="storage/avatars/`+e[2]+`" alt="" class="stu-icon float-right">
                            </div>
                        </div>
                    </li>`
                ).children().length < 3 || $('#stu-list-entry').children().last().remove()
                queue.pop()
            }

            else if(e[3] == 'exit')
            {
                $("#stu-list-exit").prepend(
                `<li class="col-md-12 animated bounceInDown">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3 id="nm2">`+e[0]+`
                                <small> <span class="float-right badge badge-${ e[5] ? 'success' : 'warning'}"> ${ e[5] ? 'enrolled' : 'not enrolled'} </span> </small>
                            </h3>
                        <p id="crs2">Course: `+((e[1] == null) ? '/' : e[1])+`</p>
                        </div>
                        <div class="icon">
                            <img src="storage/avatars/`+e[2]+`" alt="" class="stu-icon float-right">
                        </div>
                    </div>
                </li>`
                ).children().length < 3 || $('#stu-list-exit').children().last().remove()
                queue.pop()
            }

        })
        queue.push([name,course,avatar,remarks,date,enrolled]);
    }
    Echo.private('logs').listen('NewScannedLog', e =>{
        ((e.log.reader.name == "G1") ? gate(e.log) : '')
    })
})
</script>
@endsection
