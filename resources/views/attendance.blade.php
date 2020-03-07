@extends('layouts.app')

@section('content')
<div class="active tab-pane" id="attendance">
    <div class="p-2" style="display: block;">
        <div class="row">
            <div class="form-group col">
                <label for="schoolyear">School Year</label>
                <select id="schoolyear">
                    <option value="{{ $currentschoolyear }}"> Current </option>
                    @foreach ($schoolyears as $schoolyear)
                    <option value="{{ $schoolyear }}"> {{ $schoolyear }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col">
                <label for="semester">Semester</label>
                <select id="semester">
                    <option value="{{ $currentsemester }}"> Current </option>
                    @foreach ($semesters as $semester)
                    <option value="{{ $semester }}"> {{ $semester }} </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div id="calendar">

        </div>
    </div>
</div>
@endsection



@section('scripts')
<script>
    $(e => {
        const source = e => `{{ url('api/faculties') }}?schoolyear=${$('#schoolyear option:selected').val()}&semester=${$('#semester option:selected').val()}`;
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
            resourceColumns: [{ labelText: 'Name', width: '70%' },{ labelText: 'Late', field: 'late', width: '10%' },{ labelText: 'Excuse', field: 'excuse', width: '10%' },{ labelText: 'Leave', field: 'leave', width: '10%' },{ labelText: 'Absent', field: 'absent', width: '10%' },],
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
                            i.addClass(`fa-fw fad fa-${icon} my-1 ${last ? '' : 'mr-1'}`)
                            i.css('cursor', 'pointer').css('color', color)
                            i.attr('aria-label', remarks)
                            i.attr('onclick', `mark(${info.event.id},'${info.event._def.resourceIds[0]}','${remarks}')`)
                            return i
                        }
                        const div = $('<div></div>')
                        const present = set('check-circle', '#4CAF50', 'ok')
                        const excuse = set('scrubber', '#03A9F4', 'excuse')
                        const late = set('dot-circle', '#F57F17', 'late')
                        const leave = set('minus-circle', '#E91E63', 'leave')
                        const absent = set('times-circle', '#F44336', 'absent', true)
                        div.append(present).append(late).append(excuse).append(leave).append(absent)
                        return div[0]
                    },
                })
            },
            dateClick: async e => {
                const [f, id] = e.resource.id.split('$').join('').split('-')
                if(moment(e.dateStr).isAfter(moment()) || !id) {
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
                        headers: {'Accept': 'application/json','Content-Type': 'application/json'},
                        body: JSON.stringify({id:id,date:moment(e.dateStr).format('YYYY-MM-DD')}),
                    }).then(e => e.json()).catch(e => swal.fire('Error!', 'Something went wrong.', 'error')),
                ])
                if(dialog && noclass) {
                    return swal.fire('Not possible', 'Please check the course\'s schedule or the calendar', 'error')
                }
                await axios.post(`{{ route('attendance') }}`, {
                    action: 'i',
                    entity: 'f',
                    entityid: f,
                    course: id,
                    date: e.dateStr,
                    remarks: 'ok',
                }).then(e => {
                    const message = `Manually added ${e.data.log_by.name}'s remarks for ${e.data.course.title} for the date ${moment(e.data.date).format('YYYY-MM-DD')} is now ${e.data.remarks}.`;
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
            await fetch(`{{ route('attendance') }}`, {
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
            }).then(e => e.json())
            .then(e => {
                attendance.refetchEvents()
                attendance.refetchResources()
                const message = `${e.log_by.name}'s remarks for ${e.course.title} for the date ${moment(e.date).format('YYYY-MM-DD')} is now ${e.remarks}.`;
                notify(message)
            }).catch(error => swal.fire('Something went wrong', '', 'error'))
        }
        notify = e => {
            $.notify({
                icon: 'fad fa-check-circle',
                title: 'Success!<br>',
                message: e,
            },{
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
            attendance.refetchResources()
            attendance.refetchEvents()
        })
        $('#semester').on('change', e => {
            attendance.refetchResources()
            attendance.refetchEvents()
        })
    })
</script>
@endsection
