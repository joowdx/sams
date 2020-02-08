@extends('layouts.app')

@section('styles')
<style>
    .fc-sat, .fc-sun {
        color: #dc3233;
    }
    .fc td, .fc th {
        border-style: none !important;
    }
    .tippy-content {
        padding-bottom: 0px !important;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header p-2">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link" href="#faculties" data-toggle="tab">List</a></li>
            <li class="nav-item"><a class="nav-link active" href="#attendance" data-toggle="tab">Attendance</a></li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane" id="faculties">
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
            </div>
            <div class="active tab-pane" id="attendance">
                <div class="p-2" style="display: block;">
                    <div id="calendar">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(e => {
        const attendance = new Calendar(document.getElementById('calendar'), {
            plugins: [ resourceTimelinePlugin, interactionPlugin ],
            schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
            defaultView: 'resourceTimelineWeek',
            firstDay: 1,
            height: 'auto',
            header: {left: 'title', right: 'prev,today,next',},
            lazyFetching: true,
            displayEventTime: false,
            slotDuration: { day: 1 },
            slotLabelFormat: [{ weekday: 'short', day: '2-digit' }],
            resourceColumns: [{ labelText: 'Name', width: '70%' },
            { labelText: 'Late', field: 'late', width: '10%' },{ labelText: 'Excuse', field: 'excuse', width: '10%' },{ labelText: 'Leave', field: 'leave', width: '10%' },{ labelText: 'Absent', field: 'absent', width: '10%' },
            ],
            resourceAreaWidth: '35%',
            events: (e, s, f) => fetch('{{ url("api/faculties") }}').then(e => e.json()).then(e => (e.flatMap(e => e.logs))),
            resources: (e, s, f) => fetch('{{ url("api/faculties") }}').then(e => e.json()).then(e => s(e)),
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
                        const args = {
                            start: info.event.start,
                            resourceId: info.event._def.resourceIds[0],
                        }
                        const set = (icon, color, remarks, last) => {
                            const i = $('<i></i>')
                            i.addClass(`fa-fw fad fa-${icon} my-1 ${last ? '' : 'mr-1'}`)
                            i.css('cursor', 'pointer').css('color', color)
                            i.attr('onclick', `mark(${info.event.id},'${info.event._def.resourceIds[0]}','${remarks}')`)
                            return i
                        }
                        const div = $('<div></div>')
                        const present = set('check-circle', '#4CAF50', 'ok')
                        const excuse = set('scrubber', '#03A9F4', 'excuse')
                        const late = set('dot-circle', '#F57F17', 'late')
                        const leave = set('minus-circle', '#FDDB3A', 'leave')
                        const absent = set('times-circle', '#F44336', 'absent', true)
                        div.append(present).append(late).append(excuse).append(leave).append(absent)
                        return div[0]
                    },
                })
            },
            dateClicked: e => alert(e.dateStr)
        })
        attendance.render()
        mark = (eventid, resourceid, remarks) => {
            (async () => {
                console.log(resourceid)
                const [id, course] = resourceid.split('$').join('').split('-')
                const r = await fetch(`{{ route('attendance') }}`, {
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
            })();
            attendance.refetchResources()
            attendance.refetchEvents()
        }
    })
</script>
@endsection
