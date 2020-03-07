@extends('layouts.app')

@section('styles')
<style>

</style>
@endsection

@section('content')
<div class="col-md-12">
    <a href="{{ route('students.create') }}" id="add" class="btn btn-primary"><span class="fa fa-plus"></span></a>
</div>
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
                <th>
                    Modified
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
                    <b>{{ $student->program->shortname }}</b>
                    <br>
                    <small> {{ $student->program->name }} </small>
                </td>
                <td class="align-middle">
                    <small>
                        {{ $student->created_at == $student->updated_at ? 'Created' : 'Updated' }}
                    </small>

                    <br>
                    {{ $student->updated_at->format('F d, Y H:i') }}
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
