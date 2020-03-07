@extends('layouts.app')

@section('styles')
<style>
    .fc-sat, .fc-sun {
        color: #dc3233;
    }
    .fc td, .fc th {
        border-style: none !important;
    }
    .fc td.fc-time-area .fc-rows tr {
        cursor: pointer;
    }
    .tippy-content {
        padding-bottom: 0px !important;
    }
</style>
@endsection

@section('content')
<div class="p-2" style="display: block;">
    <table class="table table-borderless table-hover projects">
        <thead>
            <tr>
                <th> <i class="fad fa-hashtag"></i> </th>
                <th> ID </th>
                <th> Name </th>
                <th> Department </th>
                <th> Modified </th>
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
                    <br>
                    <small> {{ $faculty->department->name }} </small>
                </td>
                <td class="align-middle">
                    <small>
                        {{ $faculty->created_at == $faculty->updated_at ? 'Created' : 'Updated' }}
                        {{-- by {{ @$faculty->modify->name ?? 'unknown' }} --}}
                    </small>
                    <br>
                    {{ $faculty->updated_at->format('F d, Y H:i') }}
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
