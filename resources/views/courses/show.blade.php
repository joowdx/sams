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
    td.fc-widget-content {
        cursor: pointer !important;
    }
</style>
@endsection

@section('content')
@can('admin_view', App\User::class)
<div id="circularMenu" class="circular-menu">

    <a class="floating-btn" onclick="document.getElementById('circularMenu').classList.toggle('active');">
        <i class="fa fa-bars" style="color:white"></i>
    </a>

    <menu class="items-wrapper">

    <a href="{{ $course->id }}/edit" class="menu-item">
            <i class="fa fa-edit"></i>
        </a>

        <a class="menu-item">
            <form method="post" id="deleteform" action="">
                    @method('DELETE')
                        @csrf
                        <button class="btn" type="submit"><i class="fa fa-trash" style="color:white"></i></button>
            </form>
        </a>

    </menu>

</div>
@endcan
<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <strong class=""> {{ $course->title }} <p class="float-right">  {{ "$course->time_from - $course->time_to" }}</p> </strong>
                <ul class="list-group list-group-unbordered my-3">
                    <li class="list-group-item">
                        <b>Faculty</b> <a class="float-right">{{ @$course->faculty->name ?? 'no faculty set' }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Period</b> <a class="float-right">{{ strtolower(@$course->academic_period->semester) }} Semester / {{ (@$term = @$course->academic_period->term) == 'SEMESTER' ? 'Sem' : (strtolower(@$term). 'Term') }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Schedule</b> <a class="float-right">{{ "$course->day_from - $course->day_to" }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Units</b> <a class="float-right">{{$course->units}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Room</b> <a class="float-right">  {{ @$course->room->name ?? 'no room set' }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>School Year</b> <a class="float-right"> {{ @$course->academic_period->school_year ?? ''}} </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <strong><i class="fa-fw fad fa-info mr-1"></i> Other info </strong>
                <ul class="list-group list-group-unbordered my-3">
                    <li class="list-group-item">
                        <b>Faculty Absences</b> <a class="float-right">{{ $course->faculty ? (@$course->faculty->logs()->where(['course_id' => $course->id, 'remarks' => 'absent'])->count()) : 0 }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Students</b> <a class="float-right">{{ $course->students->count() }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#weekly" data-toggle="tab">Weekly</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="weekly">
                        <div class="p-2" style="display: block;">
                            <div id="calendar">
                            </div>
                        </div>
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
            resourceColumns: [{ labelText: 'Name', width: '70%' },{ labelText: 'L', field: 'late', width: '10%' },{ labelText: 'E', field: 'excuse', width: '10%' },{ labelText: 'A', field: 'absent', width: '10%' },{ labelText: 'D', field: 'dropped', width: '10%' },],
            resourceAreaWidth: '35%',
            events: (e, s, f) => fetch('{{ url("api/courses/".$course->id) }}').then(e => e.json()).then(e => s(e.logs)),
            resources: (e, s, f) => fetch('{{ url("api/courses/".$course->id) }}').then(e => e.json()).then(e => s(e.students)),
            validRange: {
                start: '{{ $course->firstmeeting() }}',
                end: '{{ $course->academic_period->end->format('Y-m-d') }}',
            },
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
                            i.attr('onclick', `mark(${info.event.id},${info.event._def.resourceIds[0].split('$')[1]},'${remarks}')`)
                            return i
                        }
                        const div = $('<div></div>')
                        const present = set('check-circle', '#4CAF50', 'ok')
                        const excuse = set('circle', '#03A9F4', 'excuse')
                        const late = set('dot-circle', '#F57F17', 'late')
                        const absent = set('times-circle', '#f44336', 'absent', true)
                        div.append(present).append(excuse).append(late).append(absent)
                        return div[0]
                    },
                })
            },
            dateClick: e => {
                const id = e.resource.id.split('$').join('').split('-')[1]
                if(moment(e.dateStr).isAfter(moment()) || !id) {
                    swal.fire('Setting attendance not possible due to:', 'Future dates', 'error')
                    return
                }
                const check = async () => {
                    const response =  await fetch(`{{ route('queryclasses') }}`, {
                        method: 'POST',
                        headers: {'Accept': 'application/json','Content-Type': 'application/json'},
                        body: JSON.stringify({id:id,date:moment(e.dateStr).format('YYYY-MM-DD')}),
                    }).then(e => e.json())
                    if(response) {
                        events = '';
                        schedule = '';
                        if(response.events) {
                            events = '<b>Events: </b>'
                            response.events.forEach(e => events += e + ',')
                            events = events.slice(0, -1) + '<br>'
                        }
                        if(response.schedule) {
                            schedule = '<b>Schedule: </b>';
                            schedule += response.schedule;
                        }
                        return swal.fire('Setting attendance not possible due to:', events + schedule, 'error')
                    }
                }
                check()
            }
        })
        attendance.render()
        mark = (eventid, resourceid, remarks) => {
            (async () => {
                const r = await fetch(`{{ url('api/attendance') }}`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        action: 'u',
                        entity: 's',
                        id: eventid,
                        entityid: resourceid,
                        remarks: remarks,
                        course: {{ $course->id }},
                        _token: '{{ csrf_token() }}',
                    })
                })
            })();
            attendance.refetchResources()
            attendance.refetchEvents()
        }
    })
</script>
@endsection
