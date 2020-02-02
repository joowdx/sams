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
                    Modified
                </th>
                <th>
                    Enrolled
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            <tr onclick="window.location='{{ route('students.show', [$student->id]) }}'" style="cursor: pointer">
                <td class="align-middle">
                    {{ $loop->iteration }}
                </td>
                <td class="align-middle">
                    <b>{{ $student->schoolid }}</b>
                    <br>
                    <small>
                        {{ $student->uid }}
                    </small>
                </td>
                <td class="align-middle">
                    <b>{{ $student->name }}</b>
                </td>
                <td class="align-middle">
                    <b>{{ $student->department->shortname }}</b>
                </td>
                <td class="align-middle">
                    <small>
                        {{ $student->created_at == $student->updated_at ? 'Created' : 'Updated' }}
                    </small>

                    <br>
                    {{ $student->updated_at->format('d F Y') }}
                </td>
                <td class="align-middle">
                    <span class="badge badge-{{ $student->enrolled() ? 'success' : 'danger' }}"> {{ $student->enrolled() ? 'yes' : 'no' }} </span>
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
