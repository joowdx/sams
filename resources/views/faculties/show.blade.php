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

<div class="row">

    <div class="col-md-12">
        <ul class="nav info">

            <li class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="">{{ $faculty->name }}</h3>
                        <p class="card-text"><strong><i class="fa-fw fad fa-tag mr-1"></i> UID: </strong>{{ $faculty->uid ?? 'no uid set' }}</p>
                        <p class="card-text"><strong><i class="fa-fw fad fa-tag mr-1"></i> Department: </strong>{{ $faculty->program->department->name ?? 'NaN' }}</p>
                    </div>
                </div>
            </li>

            <li class="col-md-4">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $courses->count() }}</h3>
                        <p>Current Courses</p>
                    </div>
                    <div class="icon">
                        <i class="box-icon fad fa-book-spells fa-fw"></i>
                    </div>
                    <a href="{{ route('faculties.courses.index', $faculty->id) }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </li>

            <li class="col-md-4">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $students->count() }}</h3>
                        <p>Students</p>
                    </div>
                    <div class="icon">
                        <i class="box-icon fad fa-users-class fa-fw"></i>
                    </div>
                    <a class="small-box-footer" disabled>More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </li>

        </ul>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header pb-1">
                <h3 class="card-title">Students</h3>
            </div>
            <div class="card-body px-4 py-4" style="display: block;">
                <table class="table table-borderless projects">
                    <thead>
                        <tr>
                            <th style="width: 20%">
                                Name
                            </th>
                            <th style="width: 30%">
                                Courses
                            </th>
                            <th style="width: 8%" class="text-center">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                        <tr>
                            <td>
                                <a href="{{ route('students.show', $student->id) }}" class="list-group-item-action">
                                    {{ $student->name }}
                                </a>
                                <br>
                                <small>
                                    {{ $student->uid }}
                                </small>
                            </td>
                            <td>
                                <ul class="list-inline">
                                    @foreach ($student->courses as $course)
                                    <li class="list-inline-item">
                                        <a href="{{ route('faculties.courses.show', [$faculty->id, $course->id]) }}" class="list-group-item-action">
                                            {{ $course->title }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="project-state">
                                <span class="badge badge-success">Success</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header pb-1">
                <h3 class="card-title">Pattern/Frequency</h3>
            </div>
            <div class="card-body px-2 py-4" style="display: block;">
                <canvas id="myChart" style="position: relative;" class="chartjs-render-monitor"></canvas>
            </div>
        </div>
    </div>

    {{-- <div class="col-md-8">
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
    </div> --}}
</div>

@endsection

@section('scripts')
<script>
    async function getData(){
        const attreq    = await fetch('http://localhost:8000/api/records');
        const attdata   = await attreq.json();
        const filter    = await attdata.filter(data => data.faculty)
        const clean     = await filter.map(data => ({
            days: new Date(data.date).toLocaleString('en-us', { weekday: 'long' }),
            facultyId: data.faculty.id,
            remarks: data.remarks,
        })).filter( e=> (e.facultyId == {{ $faculty->id }}))

        return clean;
    }

    async function getChart(){

        var data = await getData(),
            grouped = function(array) {
            var r = [];
            array.forEach(function(a) {
                if (!this[a.days]) {
                    this[a.days] = { days: a.days, late: 0, absent: 0};
                    r.push(this[a.days]);
                }
                this[a.days][a.remarks]++;
            }, Object.create(null));

            nd = [];
            nd[0] = r.find(e => e.days == 'Monday')     || {days: 'Monday', late:0,absent:0}
            nd[1] = r.find(e => e.days == 'Tuesday')    || {days: 'Tuesday', late:0,absent:0}
            nd[2] = r.find(e => e.days == 'Wednesday')  || {days: 'Wednesday', late:0,absent:0}
            nd[3] = r.find(e => e.days == 'Thursday')   || {days: 'Thursday', late:0,absent:0}
            nd[4] = r.find(e => e.days == 'Friday')     || {days: 'Friday', late:0,absent:0}
            nd[5] = r.find(e => e.days == 'Saturday')   || {days: 'Saturday', late:0,absent:0}

            r = nd;
            return r;
            }(data);

        var labels = grouped.map(function(e){
            return e.days;
        });

        var late = grouped.map(function(e){
            return e.late;
        });

        var absent = grouped.map(function(e){
            return e.absent;
        });

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Lates',
                borderColor: '#ffae42',
                fill: false,
                data: late,
                borderWidth: 1,
                order: 1
            }, {
                label: 'Absences',
                borderColor: '#d9534f',
                fill: false,
                data: absent,
                borderWidth: 1,
                order: 2
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },

                }]
            }
        }
    });

    }
    getChart();
</script>
@endsection
