@extends('layouts.app')

@section('styles')
<style>
    .fc-sat, .fc-sun {
        color: #dc3233;
    }
    .fc-today .fc-day-number {
        border: 2px solid #1b5e20 !important;
        border-radius: 15%;
    }
    .fc td, .fc-day-header {
        border-style: none !important;
    }
    .fc-highlight {
        background: #26c6da !important;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div id="calendar" class="col-lg-6">

    </div>
    <div class="col-lg-6">
        <div class="my-3 p-3 bg-white rounded box-shadow" id="logslist">
            <h6 class="border-bottom border-gray pb-2 mb-0 bold">Ongoing</h6>
            <div>
                @forelse ($ongoing as $event)
                <div class="media text-muted pt-3">
                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                        @php
                        switch ($event->remarks) {
                            case 'national holiday':
                                $color = '#f44336';
                                break;
                            case 'local holiday':
                                $color = '#ffb74d';
                                break;
                            case 'institutional event':
                                $color = '#1976d2';
                                break;
                            case 'class suspension':
                                $color = '#9c27b0';
                                break;
                            case 'break':
                                $color = '#ffc107';
                                break;
                            case 'info':
                                $color = '#4dd0e1';
                                break;
                            default:
                                $color = '#000';
                                break;
                        }
                        @endphp
                        <span class="float-right badge" style="background: {{ $color }} !important; color: white"> {{ ucwords($event->remarks) }} </span>
                        <strong class="d-block text-gray-dark">
                            {{ $event->title }}
                        </strong>
                        <strong>{{ $event->start->format('D d F') . ($event->start->eq($event->end) ? '' : ' — '. $event->start->format('D d F'))}}</strong>
                    </p>
                </div>
                @empty
                <div class="media text-muted pt-3">
                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                        <strong class="d-block text-gray-dark">
                            No ongoing event.
                        </strong>
                    </p>
                </div>
                @endforelse

            </div>
            <h6 class="border-bottom border-gray py-2 mb-0 bold">Upcoming</h6>
            <div>
                @forelse ($upcoming as $event)
                <div class="media text-muted pt-3">
                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                        @php
                        switch ($event->remarks) {
                            case 'national holiday':
                                $color = '#f44336';
                                break;
                            case 'local holiday':
                                $color = '#ffb74d';
                                break;
                            case 'institutional event':
                                $color = '#1976d2';
                                break;
                            case 'class suspension':
                                $color = '#9c27b0';
                                break;
                            case 'break':
                                $color = '#ffc107';
                                break;
                            case 'info':
                                $color = '#4dd0e1';
                                break;
                            default:
                                $color = '#000';
                                break;
                        }
                        @endphp
                        <span class="float-right badge" style="background: {{ $color }} !important; color: white"> {{ ucwords($event->remarks) }} </span>
                        <strong class="d-block text-gray-dark">
                            {{ $event->title }}
                        </strong>
                        <strong>{{ $event->start->format('D d F') . ($event->start->eq($event->end) ? '' : ' — '. $event->start->format('D d F'))}}</strong>
                    </p>
                </div>
                @empty
                <div class="media text-muted pt-3">
                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                        <strong class="d-block text-gray-dark">
                            No ongoing event.
                        </strong>
                    </p>
                </div>
                @endforelse
            </div>
            <small class="d-block text-right mt-3">
                <a href="{{ route('events.index') }}">All events</a>
            </small>
        </div>
        {{-- <h4 class="heading">
            Hello
        </h4>
        <form autocomplete="off">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="start">Start</label>
                    <input type="text" class="form-control" id="start" placeholder="YYYY-MM-DD">
                </div>
                <div class="form-group col-md-6">
                    <label for="end">End</label>
                    <input type="text" class="form-control" id="end" placeholder="YYYY-MM-DD">
                </div>
            </div>
            <div class="form-group">
                <label for="Title">Title</label>
                <input type="text" class="form-control" id="title" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="Description">Description</label>
                <textarea class="form-control" id="Description" rows="3" placeholder="Description"></textarea>
            </div>
            <div class="form-group">
                <label for="remarks">Remarks</label>
                <select id="remarks" class="form-control">
                    <option selected disabled hidden>Choose...</option>
                    <option value="institutional event"> Institutional Event </option>
                    <option value="local holiday"> Local Holiday </option>
                    <option value="national holiday"> Public Holiday </option>
                    <option value="class suspension"> Class Suspension </option>
                    <option value="info"> Information </option>
                </select>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Check me out
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add/Update</button>
        </form> --}}
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(() => {
        $.ajax({
            url: '{{ url("api/events") }}',
            success: e => {
                e.map(e => {
                    e.allDay = true
                    e.end = moment(e.end).add(1, 'days').format()
                    return e
                })
                const nationalholidays = e.filter(e => e.remarks == 'national holiday').map(e => {
                    e.color = '#f44336'
                    e.textColor = 'white'
                    e.eventClick = e => {
                        alert()
                    }
                    return e
                })
                const localholidays = e.filter(e => e.remarks == 'local holiday').map(e => {
                    e.color = '#ffb74d'
                    e.textColor = 'white'
                    return e
                })
                const breaks = e.filter(e => e.remarks == 'break').map(e => {
                    e.color = '#ffc107'
                    e.textColor = 'white'
                    return e
                })
                const institutionalevents = e.filter(e => e.remarks == 'institutional event').map(e => {
                    e.color = '#1976d2'
                    e.textColor = 'white'
                    return e
                })
                const classsuspensions = e.filter(e => e.remarks == 'class suspension').map(e => {
                    e.color = '#9c27b0'
                    e.textColor = 'white'
                    return e
                })
                const infos = e.filter(e => e.remarks == 'info').map(e => {
                    e.color = '#4dd0e1'
                    e.textColor = 'white'
                    return e
                })
                var calendar = new Calendar(document.getElementById('calendar'), {
                    plugins: [ interactionPlugin,dayGridPlugin ],
                    firstDay: 1,
                    header: {
                        left: 'title',
                        right: 'prevYear,prev,today,next,nextYear'
                    },
                    validRange: {
                        start: '{{ Carbon\Carbon::now()->subYears(4)->setMonth(1)->setDay(1)->format('Y-m-d') }}',
                        end: '{{ Carbon\Carbon::now()->addYears(4)->setMonth(12)->setDay(31)->format('Y-m-d') }}'
                    },
                    weekNumbers: true,
                    lazyFetching: true,
                    displayEventTime: false,
                    eventSources: [
                        nationalholidays,
                        localholidays,
                        institutionalevents,
                        breaks,
                        classsuspensions,
                        infos,
                    ],
                    select: e => {
                        $('#start').val(moment(e.start).format('YYYY-MM-DD'))
                        $('#end').val(moment(e.end).subtract('1', 'days').format('YYYY-MM-DD'))
                    }
                })
                calendar.render()
            },
        })

    })

</script>
@endsection
