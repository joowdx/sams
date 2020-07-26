@extends('layouts.app')

@section('styles')
<style>

</style>
@endsection

@section('content')
@can('admin_view', App\User::class)
<div id="circularMenu" class="circular-menu">

    <a class="floating-btn" onclick="document.getElementById('circularMenu').classList.toggle('active');">
        <i class="fa fa-bars" style="color:white"></i>
    </a>

    <menu class="items-wrapper">

    <a href="{{ $department->id}}/edit" class="menu-item">
            <i class="fa fa-edit"></i>
        </a>

        <a class="menu-item">
            <form method="post" id="deleteform" action="">
                    @method('DELETE')
                        @csrf
                        <button class="btn" type="submit"><i class="fa fa-trash" style="color:white"></i></button>
            </form>
        </a>

    </menu>

</div>
@endcan
<div class="row">
    <div class="col-md-3">
        <div class="card card-outline">
            <div class="card-body box-profile">
                <h3 class="profile-username">
                    {{ $department->name }}
                </h3>
                <hr>
                <strong><i class="fa-fw fad fa-book mr-1"></i> Description </strong>
                <p class="text-muted">
                    {{ $department->description ?? 'no description given' }}
                </p>
                <hr>
                <strong><i class="fa-fw fad fa-user-crown mr-1"></i> Head </strong>
                <p class="text-muted mb-0">
                    {{ @$department->faculty->name ?? 'no department head set' }}
                </p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <strong><i class="fa-fw fad fa-info mr-1"></i> Other info </strong>
                <ul class="list-group list-group-unbordered my-3">
                    <li class="list-group-item">
                        <b>Faculties</b> <a class="float-right">{{ $department->faculties->count() }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Students</b> <a class="float-right">{{ $department->students->count() }}</a>
                    </li>
                    {{-- <li class="list-group-item">
                        <b>Courses</b> <a class="float-right">{{ $department->courses->count() }}</a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#programs" data-toggle="tab">Programs</a></li>
                    <li class="nav-item"><a class="nav-link" href="#faculties" data-toggle="tab">Faculties</a></li>
                    <li class="nav-item"><a class="nav-link" href="#students" data-toggle="tab">Students</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="programs">
                        <div class="p-2" style="display: block;">
                            <table class="table table-borderless table-hover projects">
                                <thead>
                                    <tr>
                                        <th>
                                            <i class="fad fa-hashtag"></i>
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Head
                                        </th>
                                        <th>
                                            Population
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($department->programs as $program)
                                    <tr onclick="window.location='{{ route('programs.show', [$program->id]) }}'" style="cursor: pointer">
                                        <td class="align-middle">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="align-middle">
                                            <b>{{ @$program->shortname }}</b> <br>
                                            <small> {{ @$program->name }} </small>
                                        </td>
                                        <td class="align-middle">
                                            <b>{{ @$program->faculty->name }}</b> <br>
                                            <small> {{ @$program->faculty->description }} </small>
                                        </td>
                                        <td class="align-middle">
                                            <b>{{ $program->students->count() }}</b>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="faculties">
                        <div class="p-2" style="display: block;">
                            <table class="table table-borderless table-hover projects">
                                <thead>
                                    <tr>
                                        <th style="width: 1">
                                            <i class="fad fa-hashtag"></i>
                                        </th>
                                        <th style="width: 1">
                                            ID
                                        </th>
                                        <th style="width: 4">
                                            Name
                                        </th>
                                        <th style="width: 4">
                                            Program
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($department->faculties as $faculty)
                                    <tr onclick="window.location='{{ route('faculties.show', [$faculty->id]) }}'" style="cursor: pointer">
                                        <td class="align-middle">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="align-middle">
                                            <b>{{ $faculty->schoolid }}</b> <br>
                                            <small> {{ $faculty->uid }} </small>
                                        </td>
                                        <td class="align-middle">
                                            <b>{{ $faculty->name }}</b> <br>
                                            <small> {{ $faculty->description }} </small>
                                        </td>
                                        <td class="align-middle">
                                            <b>{{ $faculty->program->shortname }}</b> <br>
                                            <small> {{ $faculty->program->name }} </small>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="students">
                        <div class="p-2" style="display: block;">
                            <table class="table table-borderless table-hover projects">
                                <thead>
                                    <tr>
                                        <th>
                                            <i class="fad fa-hashtag"></i>
                                        </th>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Program
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($department->students as $student)
                                    <tr onclick="window.location='{{ route('students.show', [$student->id]) }}'" style="cursor: pointer">
                                        <td class="align-middle">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="align-middle">
                                            <b>{{ $student->schoolid }}</b> <br>
                                            <small> {{ $student->uid }} </small>
                                        </td>
                                        <td class="align-middle">
                                            <b>{{ $student->name }}</b>
                                        </td>
                                        <td class="align-middle">
                                            <b>{{ $student->program->shortname }}</b> <br>
                                            <small> {{ $student->program->name }} </small>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>

</script>
@endsection
