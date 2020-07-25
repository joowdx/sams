@extends('layouts.app')

@section('styles')
<style>
    .fc-sat,
    .fc-sun {
        color: #dc3233;
    }

    .fc-other-month .fc-day-number {
        color: #0005;
    }

    .fc-sun.fc-other-month .fc-day-number,
    .fc-sat.fc-other-month .fc-day-number {
        color: #dc323360;
    }

    .fc-row:not(.fc-widget-header) {
        cursor: pointer !important;
    }

    .fc-toolbar.fc-header-toolbar {
        margin-bottom: 0;
        padding: 0 0 1rem 0;
    }

    ul.timeline {
        list-style-type: none;
        position: relative;
    }

    ul.timeline:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        left: 29px;
        width: 2px;
        height: 100%;
        z-index: 400;
    }

    ul.timeline>li {
        margin: 0.1em 0;
        padding-left: 3rem;
    }

    ul.timeline>li:before {
        content: ' ';
        background: white;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 5px solid #22c0e8;
        left: 20px;
        width: 20px;
        height: 20px;
        z-index: 400;
    }

</style>
@endsection

@section('content')
<div class="active tab-pane" id="attendance">
    <div class="card d-print-none collapsed-card">
        <div class="card-header border-transparent pb-0">
            <h3 class="card-title">Actions</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>

        <div class="card-body "> {{-- style="display: none;"> --}}
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <div id="calendarfilter" class="m-0">

                    </div>
                </div>
                <div class="col-sm-12 col-md-5">
                    <form id="query">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input name="date" id="date" type="text" class="form-control" value="{{ @$date ?: today()->format('Y/m/d') }}"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="schoolyear">School Year</label>
                            <select name="schoolyear" id="schoolyear">
                                <option value="{{ $currentschoolyear }}"> Current </option>
                                @php $schoolyear = $schoolyear ?? null @endphp
                                @foreach ($schoolyears as $sy)
                                <option value="{{ $sy }}" @if($schoolyear == $sy) selected @endif> {{ $sy }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <select name="semester" id="semester">
                                @php $semester = $semester ?? null @endphp
                                <option value="{{ $currentsemester }}"> Current </option>
                                @foreach ($semesters as $sm)
                                <option value="{{ $sm }}" @if($semester == $sm) selected @endif> {{ $sm }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="semester">Faculty</label>
                            <select name="faculty" id="faculty" class="form-control" data-width="100%" data-live-search="true">
                                @php $faculty = $faculty ?? null @endphp
                                <option value=""> All </option>
                                @foreach ($faculties as $ft)
                                <option value="{{ @$ft->id }}" @if(@$faculty->id == @$ft->id) selected @endif> {{ @$ft->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-footer clearfix">
            <button form="query" type="button" id="resetquery" class="btn btn-sm btn-secondary float-left">Reset</button>
            <button form="query" type="submit" class="btn btn-sm btn-secondary float-right">Show Daily Report</button>
        </div>
    </div>
    @isset($records)
    <div class="">
        <h3 id="label"> {{ $semester }} Semester <small> ({{ $schoolyear }}) </small> </h3>
        <h4> {{ Carbon\Carbon::createFromFormat('Y/m/d', $date)->format('F d, Y') }} </h4>
        <table class="table table-sm table-borderless table-striped projects">
            <thead>
                <tr>
                    <th> <i class="fad fa-hashtag"></i> </th>
                    <th> Faculty </th>
                    <th> Course </th>
                    <th> Attendance </th>
                    <th> Time </th>
                    <th> Remarks </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                <tr>
                    <td class="align-middle">
                        {{ $loop->iteration }}
                    </td>
                    <td class="align-middle">
                        <small> {{ $record->log_by->schoolid }} </small> <br>
                        <b>{{ $record->log_by->name }}</b>
                    </td>
                    <td class="align-middle">
                        <small> {{ $record->course->code }} </small> <br>
                        <b>{{ $record->course->title }}</b> <br>
                        <small> {{ $record->course->time_from . ' - ' . $record->course->time_to }} </small>
                    </td>
                    <td class="align-middle">
                        @if($record->remarks != 'absent')
                        <table class="no-datatable">
                            <tbody>
                                <tr class="p-0 bg-transparent">
                                    <td class="py-0"> <small> <b> IN </b> </small> </td>
                                    <td class="py-0"> <b>:</b> </td>
                                    <td class="py-0">
                                        <small> {{ Carbon\Carbon::createFromTimeString($record->info['first'])->format('H:i') }} </small>
                                    </td>
                                </tr>
                                <tr class="p-0 bg-transparent">
                                    <td class="py-0"> <small> <b> OUT </b> </small> </td>
                                    <td class="py-0"> <b>:</b> </td>
                                    <td class="py-0">
                                        <small> {{ Carbon\Carbon::createFromTimeString($record->info['last'])->format('H:i') }} </small>
                                    </td>
                                </tr>
                                <tr class="p-0 bg-transparent">
                                    <td class="py-0"> <small> <b> DURATION </b> </small> </td>
                                    <td class="py-0"> <b>:</b> </td>
                                    <td class="py-0">
                                        <small> {{ $record->info['minutes'] }} </small>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        @endif
                    </td>
                    @if(@count(@$record->info['time']) > 2)
                    @php
                    foreach ($record->info['time'] as $time) {
                        @$timeblock.=$time."<br>";
                    }
                    @endphp
                    @endif
                    <td class="align-middle @if(@count(@$record->info['time']) > 2) tippy @endif" data-tippy-content="{!! @$timeblock !!}">
                        @if($record->remarks != 'absent')
                        @endif
                        <small>
                            @foreach (@array_slice(@$record->info['time'], 0, 2) ?: [] as $blocks)
                                {{ $blocks }}
                                @if(!$loop->last)
                                <br>
                                @endif
                            @endforeach
                            @if(@count(@$record->info['time']) > 2)
                            …
                            @endif
                        </small>

                        <br>
                    </td>
                    <td class="align-middle">
                        @php
                            switch ($record->remarks) {
                                case 'ok':  $color = '#4CAF50'; break;
                                case 'late': $color = '#F57F17'; break;
                                case 'excuse': $color = '#03A9F4'; break;
                                case 'absent': $color = '#F44336'; break;
                                case 'leave': $color = '#E91E63'; break;
                            }
                            $earlyout = @$record->remarks['additionalremarks']
                        @endphp
                        @if($record->remarks == 'ok' && !$earlyout)
                            <span class="badge" style="background: #4CAF50"> ok </span>
                        @elseif($record->remarks == 'absent')
                            <span class="badge" style="background: #F44336"> absent </span>
                        @else
                            <span class="badge" style="background: {{ $color }}"> {{ $record->remarks }} </span>
                            @if($earlyout)
                                <span class="badge" style="background: #F57F17"> early-out </span>
                            @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="p-2 d-print-none" style="display: block;">
        <h3 id="label"> {{ $currentsemester }} Semester <small> ({{ $currentschoolyear }}) </small> </h3>
        <div id="calendar">

        </div>
    </div>
    @endisset

</div>
@endsection



@section('scripts')
<script>
    $(e => {
        const source = e =>
            `{{ url('api/faculties') }}?schoolyear=${$('#schoolyear option:selected').val()}&semester=${$('#semester option:selected').val()}`;
        @empty($records)
        const attendance = new Calendar(document.getElementById('calendar'), {
            plugins: [resourceTimelinePlugin, interactionPlugin],
            schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
            defaultView: 'resourceTimelineWeek',
            firstDay: 1,
            height: 'auto',
            header: {
                left: 'title',
                right: 'prev,today,next',
            },
            lazyFetching: true,
            displayEventTime: false,
            slotDuration: {
                day: 1
            },
            slotLabelFormat: [{
                weekday: 'short',
                day: '2-digit'
            }],
            resourceColumns: [{
                labelText: 'Name',
                width: '70%'
            }, {
                labelText: 'Late',
                field: 'late',
                width: '10%'
            }, {
                labelText: 'Excuse',
                field: 'excuse',
                width: '10%'
            }, {
                labelText: 'Leave',
                field: 'leave',
                width: '10%'
            }, {
                labelText: 'Absent',
                field: 'absent',
                width: '10%'
            }, ],
            resourceAreaWidth: '35%',
            resources: () => axios(source()).then(e => e.data),
            events: () => axios(source()).then(e => e.data.flatMap(e => e.logs)),
            eventPositioned: info => {
                let icon = info.event.extendedProps.icon
                let title = $(info.el)
                if (icon !== undefined) {
                    title.css('height', '100%')
                    title.prop('href', 'javascript:void(0)')
                    title.prepend("<i class='fad fa-" + icon + " mr-1'></i>")
                    title.addClass('m-0 border-0')
                    title.first('span').addClass('d-flex align-items-center')
                }
                tippy(info.el, {
                    trigger: 'click',
                    placement: 'right-center',
                    interactive: true,
                    appendTo: document.body,
                    content: e => {
                        const set = (icon, color, remarks, last) => {
                            const i = $('<i></i>')
                            i.addClass(
                                `fa-fw fad fa-${icon} my-1 ${last ? '' : 'mr-1'}`
                            )
                            i.css('cursor', 'pointer').css('color', color)
                            i.attr('aria-label', remarks)
                            i.attr('onclick',
                                `mark(${info.event.id},'${info.event._def.resourceIds[0]}','${remarks}')`
                            )
                            return i
                        }
                        const div = $('<div></div>')
                        const present = set('check-circle', '#4CAF50', 'ok')
                        const excuse = set('scrubber', '#03A9F4', 'excuse')
                        const late = set('dot-circle', '#F57F17', 'late')
                        const leave = set('minus-circle', '#E91E63', 'leave')
                        const absent = set('times-circle', '#F44336', 'absent', true)
                        div.append(present).append(late).append(excuse).append(leave)
                            .append(absent)
                        return div[0]
                    },
                })
            },
            dateClick: async e => {
                const [f, id] = e.resource.id.split('$').join('').split('-')
                if (moment(e.dateStr).isAfter(moment()) || !id) {
                    return
                }
                const [dialog, noclass] = await Promise.all([
                    swal.fire({
                        title: 'Continue?',
                        text: 'Force add a record manually',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'I know what I\'m doing',
                        cancelButtonText: 'No',
                    }).then(e => e.value),
                    fetch(`{{ route('queryclasses') }}`, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id: id,
                            date: moment(e.dateStr).format('YYYY-MM-DD')
                        }),
                    }).then(e => e.json()).catch(e => swal.fire('Error!',
                        'Something went wrong.', 'error')),
                ])
                if (dialog && noclass) {
                    return swal.fire('Not possible',
                        'Please check the course\'s schedule or the calendar', 'error')
                }
                await axios.post(`{{ route('attendance') }}`, {
                    action: 'i',
                    entity: 'f',
                    entityid: f,
                    course: id,
                    date: e.dateStr,
                    remarks: 'ok',
                }).then(e => {
                    const message =
                        `Manually added ${e.data.log_by.name}'s remarks for ${e.data.course.title} for the date ${moment(e.data.date).format('YYYY-MM-DD')} is now ${e.data.remarks}.`;
                    attendance.refetchEvents()
                    notify(message)
                }).catch(e => swal.fire('Error!', 'Something went wrong.', 'error'))
            }
        })
        attendance.render()
        mark = async (eventid, resourceid, remarks) => {
            [...document.querySelectorAll('*')].forEach(node => {
                if (node._tippy) {
                    node._tippy.hide();
                }
            });
            const [id, course] = resourceid.split('$').join('').split('-')
            await fetch(`{{ route('api.attendance') }}`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        action: 'u',
                        entity: 'f',
                        id: eventid,
                        entityid: id,
                        course: course,
                        remarks: remarks,
                    })
                })
                .then(e => e.json())
                .then(e => {
                    attendance.refetchEvents()
                    attendance.refetchResources()
                    const message =
                        `${e.log_by.name}'s remarks for ${e.course.title} for the date ${moment(e.date).format('YYYY-MM-DD')} is now ${e.remarks}.`;
                    notify(message)
                }).catch(error => swal.fire('Something went wrong', '', 'error'))
        }
        @endempty
        notify = e => {
            $.notify({
                icon: 'fad fa-check-circle',
                title: 'Success!<br>',
                message: e,
            }, {
                type: "success",
                placement: {
                    from: "bottom",
                    align: "right"
                },
                animate: {
                    enter: 'animated fadeInRight',
                    exit: 'animated fadeOutRight'
                },
            })
        }
        $('#schoolyear').on('change', e => {
            $('#label').html(
                `${$('#semester').val()} Semester <small> (${$('#schoolyear').val()}) </small>`)
            attendance.refetchResources()
            attendance.refetchEvents()
        })
        $('#semester').on('change', e => {
            $('#label').html(
                `${$('#semester').val()} Semester <small> (${$('#schoolyear').val()}) </small>`)
            attendance.refetchResources()
            attendance.refetchEvents()
        })
        $('#resetquery').on('click', e => location = '{{ route('attendance') }}')
        new Calendar(document.getElementById('calendarfilter'), {
            plugins: [dayGridPlugin, interactionPlugin],
            schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
            defaultView: 'dayGridMonth',
            firstDay: 1,
            header: {
                left: 'title',
                right: 'prev,today,next',
            },
            selectable: true,
            selectAllow: function (e) {
                if (e.end.getTime() / 1000 - e.start.getTime() / 1000 <= 86400) {
                    return true;
                }
            },
            select: e => {
                @empty($records)
                attendance.gotoDate(e.start)
                @endempty
                $('#date').val(moment(e.start).format('YYYY/MM/DD'))
            }
        }).render()
        tippy(document.querySelectorAll('td.tippy'), { placement: 'right' })
    })
</script>
@endsection
