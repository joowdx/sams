@extends('layouts.app')

@section('styles')
<style>

</style>
@endsection

@section('content')
<div class="col-md-12">
    <a href="{{ route('programs.create') }}" id="add" class="btn btn-primary"><span class="fa fa-plus"></span></a>
</div>
<div class="p-2" style="display: block;">
    <table class="table table-borderless table-hover projects">
        <thead>
            <tr>
                <th style="width: 1">
                    <i class="fad fa-hashtag"></i>
                </th>
                <th style="width: 5">
                    Name
                </th>
                <th style="width: 5">
                    Department
                </th>
                <th style="width: 5">
                    Head
                </th>
                <th style="width: 1">
                    Faculties
                </th>
                <th style="width: 1">
                    Population
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($programs as $program)
            <tr onclick="window.location='{{ route('programs.show', [$program->id]) }}'" style="cursor: pointer">
                <td class="align-middle">
                    {{ $loop->iteration }}
                </td>
                <td>
                    <li class="list-inline-item">
                        <b>{{ $program->shortname }}</b>
                        <br>
                        <small>
                            {{ $program->name }}
                        </small>
                    </li>
                </td>
                <td>
                    <li class="list-inline-item">
                        <b>{{ $program->department->shortname }}</b>
                        <br>
                        <small>
                            {{ $program->department->name }}
                        </small>
                    </li>
                </td>
                <td>
                    <small>
                        {{ $program->faculty->uid ?? '' }}
                    </small>
                    <br>
                    {{ $program->faculty->name ?? '' }}
                </td>
                <td class="align-middle">
                    {{ $program->faculties->count() }}
                </td>
                <td class="align-middle">
                    {{ $program->students->filter(function($s) { return $s->enrolled(); } )->count() }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>

</script>
@endsection
