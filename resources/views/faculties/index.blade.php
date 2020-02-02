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
                    Department
                </th>
                <th>
                    Courses
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($faculties as $faculty)
            <tr onclick="window.location='{{ route('faculties.show', [$faculty->id]) }}'" style="cursor: pointer">
                <td class="align-middle">
                    {{ $loop->iteration }}
                </td>
                <td class="align-middle">
                    <b>{{ $faculty->schoolid }}</b>
                    <br>
                    <small>
                        {{ $faculty->uid }}
                    </small>
                </td>
                <td class="align-middle">
                    <b>{{ $faculty->name }}</b>
                </td>
                <td class="align-middle">
                    <b>{{ $faculty->department->shortname }}</b>
                </td>
                <td class="align-middle">
                    {{ $faculty->courses->count() }}
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
