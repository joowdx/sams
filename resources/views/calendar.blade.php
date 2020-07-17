@extends('layouts.app')

@section('styles')
<style>
    div.fc-content-skeleton {
        cursor: pointer !important;
    }
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
            <h6 class="border-bottom border-gray pb-2 mb-0 bold"><b>Ongoing</b></h6>
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
            <h6 class="border-bottom border-gray py-2 mb-0 bold"><b>Upcoming</b></h6>
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
    <div class="modal-dialog modal-dialog-centered" role="document" id="modalnew">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">New event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="newevent" method="POST" action="{{ url('api/events') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="date" class="col-md-4 col-form-label text-md-right">Start</label>

                        <div class="col-md-6">
                            <input id="start" type="text" class="form-control @error('date') is-invalid @enderror" name="start" required autocomplete="new-date" placeholder="Format: dd/mm/yyyy"  value="{{ old('date') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="date" class="col-md-4 col-form-label text-md-right">End</label>

                        <div class="col-md-6">
                            <input id="end" type="text" class="form-control @error('date') is-invalid @enderror" name="end" required autocomplete="new-date" placeholder="Format: dd/mm/yyyy"  value="{{ old('date') }}">
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

                    <div class="form-group row">
                        <label for="remarks" class="col-md-4 col-form-label text-md-right">Remarks</label>

                        <div class="col-md-6">
                            <select id="remarks" name="remarks" data-width="100%">
                                <option value="national holiday"> National Holiday </option>
                                <option value="local holiday"> Local Holiday </option>
                                <option value="institutional event"> Institutional Event </option>
                                <option value="class suspension"> Class Suspension </option>
                                <option value="break"> Break </option>
                                <option value="info"> Info </option>
                            </select>
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

<div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" id="modalview">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventsviewtitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="eventsviewbody" class="modal-body">
                <table class="no-datatable table table-borderless table-hover projects">
                    <thead>
                        <tr>
                            <th width="35%"> Date </th>
                            <th width="50%"> Event </th>
                            {{-- <th width="10%"> Remarks </th> --}}
                            <th width="15%"> Action </th>
                        </tr>
                    </thead>
                    <tbody id="eventstablebody">

                    <tbody>
                </table>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(e => {
        $.ajax({
            url: '{{ url("api/events/0") }}',
            // method: 'post',
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
                    dateClick: function(e) {
                        ctrl(this, e)
                    }
                }).render()
            },
        })
        $('#newevent').on('submit', function(e) {
            $.ajax({
                url: this.action,
                method: this.method,
                data: $(this).serialize(),
                success: function(e) {
                    swal.fire({
                        title: 'Success?',
                        text: "Please refresh!",
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, reload!'
                    }).then((result) => {
                        if (result.value) {
                            location.reload()
                        }
                    })
                },
                error: function(x, s, e) {
                    if(x.status == 400) {
                        swal.fire(
                            'Bad Request',
                            "Please check your inputs!",
                            'error',
                        )
                    } else if(x.status == 500) {
                        swal.fire(
                            'Server error',
                            "Please contact your administrator!",
                            'error',
                        )
                    }
                }
            })
            e.preventDefault();
        })
        ctrl = (cal, f) => {
            $('#eventstablebody').html('')
            evt = cal.getEvents()
            .filter(e => {
                return moment(f.dateStr).isBetween(moment(e.start), moment(e.end).subtract(1, 'days'), null, '[]')
            })
            evt.forEach(e => {
                date = $('<td class="align-middle"></td>').html(moment(e.start).isSame(moment(e.end).subtract(1, 'days')) ? moment(e.start).format('LL') : moment(e.start).format('LL') + '<br>' + moment(e.end).subtract(1, 'days').format('LL'))
                event = $('<td class="align-middle"></td>').html(e.title).append(`<br><small>${e.extendedProps.description}</small>`).prepend($(`<small class="badge" style="background: ${clr(e.extendedProps.remarks)}!important">${e.extendedProps.remarks}</small><br>`))
                // remarks = $('<td class="align-middle"></td>').html(e.extendedProps.remarks)
                del = $('<td class="align-middle"></td>').html($('<button class="btn btn-transparent"></button>').html($('<span></span>').addClass('fa-fw fad fa-trash')).on('click', z => dlt(e))).append($('<button class="btn btn-transparent"></button>').html($('<span></span>').addClass('fa-fw fad fa-edit')).on('click', z => edt(e)))
                $('#eventstablebody').append($('<tr></tr>').append(date).append(event).append(del));
            })
            if(evt.length) {
                $('#eventsviewtitle').html('Events on ' + moment(f.dateStr).format('LL'))
                $('#view').modal('show')
            }



            // .forEach(e => console.log(e));
        }
        edt = evt => {
            location.href = (`events/${evt.extendedProps.eventid}/edit`)
        }
        window.dlt = evt => {
            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: 'api/events/' + evt.extendedProps.eventid,
                        type: 'delete',
                        success: function() {
                            swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then(e => {
                                location.reload(true)
                            })
                        },
                        error: function() {
                            swal.fire(
                                'Server error',
                                "Please contact your administrator!",
                                'error',
                            )
                        }
                    })
                }
            })
        }
        clr = rmk => {
            switch (rmk) {
                case 'national holiday': return '#F44336';
                case 'local holiday': return '#FFB74D';
                case 'institutional event': return '#1976D2';
                case 'class suspension': return '#9C27B0';
                case 'break': return '#FFC107';
                case 'info': return '#4DD0E1';
                default: return '#0000';
            }
        }
    })

</script>
@endsection
