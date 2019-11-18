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

li.info{
    display: inline-block;
}
.vl {
  border-left: 1px solid #181a1b !important;
}
.democlass {
  color: red;
}
</style>
@endsection

@section('content')


    <div class="row">

        <div id="circularMenu" class="circular-menu">

            <a class="floating-btn" onclick="document.getElementById('circularMenu').classList.toggle('active');">
                <i class="fa fa-bars" style="color:white"></i>
            </a>

            <menu class="items-wrapper">

                <a href="{{ $faculty->id }}/edit" class="menu-item">
                    <i class="fa fa-edit"></i>
                </a>

                <a class="menu-item">
                    <form method="post" id="deleteform" action="{{ route('faculties.destroy', $faculty->id) }}">
                            @method('DELETE')
                                @csrf
                                <button class="btn" type="submit"><i class="fa fa-trash" style="color:white"></i></button>
                    </form>
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
                <li class="col-md-2 text-center"><h1>1</h1>Total Number of Students</li>
                <li class="vl"></li>
                <li class="col-md-2 text-center"><h1>1</h1>Total Number of Classes</li>
            </ul>

            <hr>

        </div>

    </div>


    <div class="row mt-3">

        <div class="col-md-4">
           <h1>Classes</h1>
            <table id="classestable" class="table table-bordered clickable-row" style="cursor:pointer;">
                <thead class="bg-custom">
                    <tr>
                        <th scope="col" hidden>Course ID</th>
                        <th scope="col">Course Code</th>
                        <th scope="col">Course Title</th>
                        <th scope="col">Course Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr>
                            <th class="course-id" scope="row" hidden>{{ $course->id }}</th>
                            <th>{{ $course->code }}</th>
                            <td>{{ $course->title }}</td>
                            <td>{{ $course->description }}</td>
                        </tr>
                    @endforeach
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
                <thead class="bg-custom">
                    <tr>
                        <th scope="col" hidden>Student ID</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Student Course</th>
                        <th scope="col">Unexcused Absence</th>
                        <th scope="col">Excused Absence</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($course->students as $student)
                        <tr>
                            <th scope="row" hidden>{{ $student->id }}</th>
                            <td> {{ $student->name }} </td>
                            <td>BSIT</td>
                            <td>6</td>
                            <td>9</td>
                            <td>
                                <div class="emphasis">
                                    <form method="post" id="studentdeleteform" action="{{ route('students.destroy', $student->id) }}">
                                        @method('DELETE')
                                            @csrf
                                                <button class="btn btn-danger btn-block btn-delete" type="submit"><span class="fa fa-trash"></span></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
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
});

$('#classestable').on('click', 'tr', function(){
    var data = $('th.course-id', this)[0].innerHTML;

});


</script>
@endsection
