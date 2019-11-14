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
li{
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

        <div class="col-md-2">
            <div id="wrapper">
                <div><i class="fa fa-user-circle" id="user" aria-hidden="true"></i></div>
            </div>
        </div>

        <div class="col-md-10">

            <h1>{{ $faculty->name }}</h1>
            <h3>ID: {{ $faculty->uid }}</h3>

            <hr>

            <ul class="nav">
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
