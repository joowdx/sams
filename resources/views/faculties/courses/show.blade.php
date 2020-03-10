@extends('layouts.app')

@section('styles')
<style>

</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="p-2" style="display: block;">
            <div class="active tab-pane" id="weekly">
                <div class="p-2" style="display: block;">
                    <div class="border" id="calendar">
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
            resourceColumns: [{ labelText: 'Name', width: '70%' },{ labelText: 'A', field: 'absent', width: '10%' },{ labelText: 'L', field: 'late', width: '10%' },{ labelText: 'E', field: 'excuse', width: '10%' },],
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
                    return
                }
                const check = async () => {
                    const response =  await fetch(`{{ route('queryclasses') }}`, {
                        method: 'POST',
                        headers: {'Accept': 'application/json','Content-Type': 'application/json'},
                        body: JSON.stringify({id:id,date:moment().format('YYYY-MM-DD')}),
                    }).then(e => e.json())
                    if(response) {
                        return swal.fire('Not possible', 'Please check the course\'s schedule or the calendar', 'error')
                    }
                }
                check()
            }
        })
        attendance.render()
        mark = (eventid, resourceid, remarks) => {
            (async () => {
                const r = await fetch(`{{ route('attendance') }}`, {
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
                        course: {{ $course->id }}
                    })
                })
            })();
            attendance.refetchResources()
            attendance.refetchEvents()
        }
    })
</script>
@endsection
