@extends('layouts.app')

@section('styles')
<style>

</style>
@endsection

@section('content')
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
            @foreach ($departments as $department)
            <tr onclick="window.location='{{ route('departments.show', [$department->id]) }}'" style="cursor: pointer">
                <td class="align-middle">
                    {{ $loop->iteration }}
                </td>
                <td>
                    <li class="list-inline-item">
                        <b>{{ $department->shortname }}</b>
                        <br>
                        <small>
                            {{ $department->name }}
                        </small>
                    </li>
                </td>
                <td>
                    <small>
                        {{ $department->faculty->uid ?? '' }}
                    </small>
                    <br>
                    {{ $department->faculty->name ?? '' }}
                </td>
                <td class="align-middle">
                    {{ $department->faculties->count() }}
                </td>
                <td class="align-middle">
                    {{ $students->filter(function($student) use($department) { return $student->department->id == $department->id && $student->enrolled(); })->count() }}
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
