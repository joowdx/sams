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
                    Period
                </th>
                <th>
                    Date
                </th>
                <th>
                    Modified
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($periods as $period)
            <tr onclick="window.location='{{ route('academicperiods.show', [$period->id]) }}'" style="cursor: pointer">
                <td class="align-middle">
                    {{ $loop->iteration }}
                </td>
                <td>
                    <p class="m-0 p-0">
                    @if($period->term != 'SEMESTER' && $this->semester != 'SUMMER')
                        <b>{{ $period->semester }}</b> <small> Sem </small>/
                        <b>{{ $period->term }} </b> <small> Term </small>
                    @else
                        <b>{{ $period->semester }}</b>
                        @if($period->semester != 'SUMMER') <small> Sem </small> @endif
                    @endif
                    </p>
                    <small>
                        SY: {{ $period->school_year }}
                    </small>
                </td>
                <td class="align-middle">
                    <small> <b> Start: </b> </small> {{ $period->start->format('M d, Y') }}
                    <br>
                    <small> <b> End: </b> </small> {{ $period->end->format('M d, Y') }}
                    <br>
                </td>
                <td class="align-middle">
                    <small>
                        {{ $period->created_at == $period->updated_at ? 'Created' : 'Updated' }}
                        {{-- by {{ @$faculty->modify->name ?? 'unknown' }} --}}
                    </small>
                    <br>
                    {{ $period->updated_at->format('F d, Y H:i') }}
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
