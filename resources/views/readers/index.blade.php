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
                    Reader
                </th>
                <th>
                    Modified
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($readers as $reader)
            <tr onclick="window.location='{{ route('readers.show', [$reader->id]) }}'" style="cursor: pointer">
                <td class="align-middle">
                    {{ $loop->iteration }}
                </td>
                <td>
                    <p class="m-0 p-0">
                        <small>{{ ucfirst($reader->type) }}</small> <b> {{ $reader->name }} </b>
                    </p>
                    <small>
                        IP: {{ $reader->ip ?? 'Not set' }}
                    </small>
                </td>
                <td class="align-middle">
                    <small>
                        {{ $reader->created_at == $reader->updated_at ? 'Created' : 'Updated' }}
                        {{-- by {{ @$faculty->modify->name ?? 'unknown' }} --}}
                    </small>
                    <br>
                    {{ $reader->updated_at->format('F d, Y H:i') }}
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
