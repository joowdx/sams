@extends('layouts.app')

@section('styles')
<style>
    .fc-sat, .fc-sun {
        color: #dc3233;
    }
    .fc-today .fc-day-number {
        border: 2px solid #1b5e20 !important;
        border-radius: 12%;
        background: #1b5e20;
        color: #ecf0f1;
    }
    .fc td, .fc-day-header {
        border-style: none !important;
    }
    .fc-other-month .fc-day-number {
        color: #0005;
    }
    .fc-sun.fc-other-month .fc-day-number, .fc-sat.fc-other-month .fc-day-number {
        color: #dc323360;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <button id="add" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><span class="fa fa-plus"></span></button>
    </div>
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

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">New event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="newevent" method="post" action="{{ route('programs.store') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="date" class="col-md-4 col-form-label text-md-right">Start</label>

                        <div class="col-md-6">
                            <input id="date" type="text" class="form-control @error('date') is-invalid @enderror" name="start" required autocomplete="new-date" placeholder="Format: dd/mm/yyyy"  value="{{ old('date') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="date" class="col-md-4 col-form-label text-md-right">End</label>

                        <div class="col-md-6">
                            <input id="date" type="text" class="form-control @error('date') is-invalid @enderror" name="end" required autocomplete="new-date" placeholder="Format: dd/mm/yyyy"  value="{{ old('date') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="title" required autocomplete="new-name" placeholder="Ex. New year"  value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="new-description" placeholder="Ex. New years celebration"  value="{{ old('description') }}">
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button form="newevent" type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(e => {
        $.ajax({
            url: '{{ url("api/events") }}',
            success: e => {
                new Calendar(document.getElementById('calendar'), {
                    plugins: [ dayGridPlugin, interactionPlugin ],
                    schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
                    defaultView: 'dayGridMonth',
                    firstDay: 1,
                    header: {
                        left: 'title',
                        right: 'prevYear,prev,today,next,nextYear',
                    },
                    validRange: {
                        start: '{{ Carbon\Carbon::now()->subYears(4)->setMonth(1)->setDay(1)->format('Y-m-d') }}',
                        end: '{{ Carbon\Carbon::now()->addYears(4)->setMonth(12)->setDay(31)->format('Y-m-d') }}'
                    },
                    lazyFetching: true,
                    displayEventTime: false,
                    eventSources: [
                        e
                    ],
                    eventRender: e => {
                        console.log(e)
                        tippy(e.el, {
                            appendTo: document.body,
                            content: () => {
                                const container = $('<div></div').addClass('p-2')
                                const title = $('<h6></h6>').html(e.event.title)
                                container.html(title)
                                container.prepend($('<span></span>').html(e.event.extendedProps.remarks).addClass('badge').css('background', e.event.backgroundColor))
                                container.append($('<hr>').addClass('m-0 p-1'))
                                container.append($('<p></p>').html(e.event.extendedProps.description).addClass('m-0'))
                                return container[0]
                                // return e.event.extendedProps.description
                            },
                            popperOptions: {
                                modifiers: {
                                    computeStyle: {
                                        gpuAcceleration: false
                                    }
                                }
                            }
                        })
                    },
                    dateClick: e => alert(e.dateStr)
                }).render()
            },
        })
        $('#newevent').on('submit', function(e) {
            $.ajax({
                url: this.action,
                memthod: this.method,
                data: $(this).serialize(),
                success: function(e) {

                },
                error: function(e) {

                }
            })
            e.preventDefault();
            console.log($(this).serialize())
        })
    })

</script>
@endsection
