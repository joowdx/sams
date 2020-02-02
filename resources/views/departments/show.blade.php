@extends('layouts.app')

@section('styles')
<style>

</style>
@endsection

@section('content')
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
                    <li class="list-group-item">
                        <b>Courses</b> <a class="float-right">{{ $department->courses->count() }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#faculties" data-toggle="tab">Faculties</a></li>
                    <li class="nav-item"><a class="nav-link" href="#students" data-toggle="tab">Students</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="faculties">
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
                                            Courses
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
                                            <b>{{ $faculty->schoolid }}</b>
                                        </td>
                                        <td class="align-middle">
                                            <b>{{ $faculty->name }}</b>
                                        </td>
                                        <td class="align-middle">
                                            {{ $faculty->courses->count() }}
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
                                            Courses
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
                                            <b>{{ $student->schoolid }}</b>
                                        </td>
                                        <td class="align-middle">
                                            <b>{{ $student->name }}</b>
                                        </td>
                                        <td class="align-middle">
                                            {{ $student->courses->count() }}
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
