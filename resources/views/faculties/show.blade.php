@extends('layouts.app')

@section('styles')
<style>
#user {
  display: inline-block;
  width: 150px;
  height: 150px;
  border-radius: 50%;

  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
}
#wrapper{
    text-align: center;
}
li.info{
    display: inline-block;
}
.vl {
  border-left: 1px solid #181a1b !important;
}
.democlass {
  color: red;
}
body {
  background-color: #EDEDED;
}
.circular-menu {
  position: fixed;
  bottom: 1em;
  right: 1em;
  z-index: 1000;
}

.circular-menu .floating-btn {
  display: block;
  width: 3.5em;
  height: 3.5em;
  border-radius: 50%;
  background-color: hsl(217, 89%, 61%);
  box-shadow: 0 2px 5px 0 hsla(0, 0%, 0%, .26);
  color: hsl(0, 0%, 100%);
  text-align: center;
  line-height: 3.9;
  cursor: pointer;
  outline: 0;
}

.circular-menu.active .floating-btn {
  box-shadow: inset 0 0 3px hsla(0, 0%, 0%, .3);
}

.circular-menu .floating-btn:active {
  box-shadow: 0 4px 8px 0 hsla(0, 0%, 0%, .4);
}

.circular-menu .floating-btn i {
  font-size: 1.3em;
  transition: transform .2s;
}

.circular-menu.active .floating-btn i {
  transform: rotate(-45deg);
}

.circular-menu:after {
  display: block;
  content: ' ';
  width: 3.5em;
  height: 3.5em;
  border-radius: 50%;
  position: absolute;
  top: 0;
  right: 0;
  z-index: -2;
  background-color: hsl(217, 89%, 61%);
  transition: all .3s ease;
}

.circular-menu.active:after {
  transform: scale3d(5.5, 5.5, 1);
  transition-timing-function: cubic-bezier(.68, 1.55, .265, 1);
}

.circular-menu .items-wrapper {
  padding: 0;
  margin: 0;
}

.circular-menu .menu-item {
  position: absolute;
  top: .2em;
  right: .2em;
  z-index: -1;
  display: block;
  text-decoration: none;
  color: hsl(0, 0%, 100%);
  font-size: 1em;
  width: 3em;
  height: 3em;
  border-radius: 50%;
  text-align: center;
  line-height: 3;
  background-color: hsla(0,0%,0%,.1);
  transition: transform .3s ease, background .2s ease;
}

.circular-menu .menu-item:hover {
  background-color: hsla(0,0%,0%,.3);
}

.circular-menu.active .menu-item {
  transition-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1.275);
}



.circular-menu.active .menu-item:nth-child(1) {
  transform: translate3d(-3.5em,-6.3em,0);
}

.circular-menu.active .menu-item:nth-child(2) {
  transform: translate3d(-6.5em,-3.2em,0);
}


</style>
@endsection

@section('content')


    <div class="row">

            <div id="circularMenu" class="circular-menu">

                <a class="floating-btn" onclick="document.getElementById('circularMenu').classList.toggle('active');">
                    <i class="fa fa-bars"></i>
                </a>

                <menu class="items-wrapper">

                    <a href="#" class="menu-item">
                        <i class="fa fa-plus"></i>
                    </a>
                    <a href="#" class="menu-item">
                        <i class="fa fa-edit"></i>
                    </a>

                </menu>

            </div>

        <div class="col-md-2">
            <div id="wrapper">
                <div><i class="fa fa-user-circle" id="user" aria-hidden="true"></i></div>
            </div>
        </div>

        <div class="col-md-10">

            <h1>{{ $faculty->name }}</h1>
            <h3>ID: {{ $faculty->uid }}</h3>

            <hr>

            <ul class="nav info">
                <li class="col-md-2 text-center"><h1>{{  $students->count() }}</h1>Total Number of Students</li>
                <li class="vl"></li>
                <li class="col-md-2 text-center"><h1>{{  $courses->count() }}</h1>Total Number of Classes</li>
            </ul>

        </div>

    </div>


    <div class="row mt-3">

        <div class="col-md-4">
           <h1>Classes</h1>
            <table id="classestable" class="table table-bordered clickable-row" style="cursor:pointer;">
                <thead>
                    <tr>
                        <th scope="col">Course Code</th>
                        <th scope="col">Course Title</th>
                        <th scope="col">Course Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($courses as $course)
                            <th scope="row">{{ $course->code }}</th>
                            <td>{{ $course->title }}</td>
                            <td>{{ $course->description }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-8">

            <ul class="nav">
                    <li><h1 id="haha">Students</h1></li>
                    <li class="col-md-5">
                            <small>Student Percentage</small>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped" id="instudent"  role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="50"></div>
                        </div>
                    </li>
            </ul>

            <table id="studentstable" class="table table-bordered" style="cursor:pointer;">
                <thead>
                    <tr>
                        <th scope="col">Student ID</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Student Course</th>
                        <th scope="col">Unexcused Absence</th>
                        <th scope="col">Excused Absence</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($students as $student)
                            <th scope="row">{{ $student->id}}</th>
                            <td> {{ $student->name}} </td>
                            <td>BSIT</td>
                            <td>6</td>
                            <td>9</td>
                            <td>
                                <div class="emphasis">
                                <form method="post" id="deleteform" action="{{ route('faculties.destroy', $student->id) }}">
                                    @method('DELETE')
                                        @csrf
                                            <button class="btn btn-danger btn-block btn-delete" type="submit"><span class="fa fa-trash"></span>Delete</button>
                                </form>
                                </div>
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

@endsection

@section('scripts')
<script>
$(document).ready(function(){
    var rowCount = $('#studentstable tr').length - 1;
    var result = (rowCount/50) * 100;
    console.log(result);
    $('#instudent').css('width', result+'%');
});

$('.btn-delete').click(function(e){
    swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $('#deleteform').submit()
        }
    })
    e.preventDefault()
})
</script>
@endsection
