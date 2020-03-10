@extends('layouts.app')

@section('content')
<div class="active tab-pane" id="attendance">
    <div class="col-md-6">
        <!-- DIRECT CHAT -->
        <div class="card direct-chat direct-chat-warning">
          <div class="card-header">
            <h3 class="card-title">Direct Chat</h3>

            <div class="card-tools">
              <span data-toggle="tooltip" title="3 New Messages" class="badge badge-warning">3</span>
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                <i class="fas fa-comments"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body" style="display: block;">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages">
              <!-- Message. Default to the left -->
              <div class="direct-chat-msg">
                <div class="direct-chat-infos clearfix">
                  <span class="direct-chat-name float-left">Alexander Pierce</span>
                  <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                </div>
                <!-- /.direct-chat-infos -->
                <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">
                <!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  Is this template really for free? That's unbelievable!
                </div>
                <!-- /.direct-chat-text -->
              </div>
              <!-- /.direct-chat-msg -->

              <!-- Message to the right -->
              <div class="direct-chat-msg right">
                <div class="direct-chat-infos clearfix">
                  <span class="direct-chat-name float-right">Sarah Bullock</span>
                  <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                </div>
                <!-- /.direct-chat-infos -->
                <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">
                <!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  You better believe it!
                </div>
                <!-- /.direct-chat-text -->
              </div>
              <!-- /.direct-chat-msg -->

              <!-- Message. Default to the left -->
              <div class="direct-chat-msg">
                <div class="direct-chat-infos clearfix">
                  <span class="direct-chat-name float-left">Alexander Pierce</span>
                  <span class="direct-chat-timestamp float-right">23 Jan 5:37 pm</span>
                </div>
                <!-- /.direct-chat-infos -->
                <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">
                <!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  Working with AdminLTE on a great new app! Wanna join?
                </div>
                <!-- /.direct-chat-text -->
              </div>
              <!-- /.direct-chat-msg -->

              <!-- Message to the right -->
              <div class="direct-chat-msg right">
                <div class="direct-chat-infos clearfix">
                  <span class="direct-chat-name float-right">Sarah Bullock</span>
                  <span class="direct-chat-timestamp float-left">23 Jan 6:10 pm</span>
                </div>
                <!-- /.direct-chat-infos -->
                <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">
                <!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  I would love to.
                </div>
                <!-- /.direct-chat-text -->
              </div>
              <!-- /.direct-chat-msg -->

            </div>
            <!--/.direct-chat-messages-->

            <!-- Contacts are loaded here -->
            <div class="direct-chat-contacts">
              <ul class="contacts-list">
                <li>
                  <a href="#">
                    <img class="contacts-list-img" src="dist/img/user1-128x128.jpg">

                    <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        Count Dracula
                        <small class="contacts-list-date float-right">2/28/2015</small>
                      </span>
                      <span class="contacts-list-msg">How have you been? I was...</span>
                    </div>
                    <!-- /.contacts-list-info -->
                  </a>
                </li>
                <!-- End Contact Item -->
                <li>
                  <a href="#">
                    <img class="contacts-list-img" src="dist/img/user7-128x128.jpg">

                    <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        Sarah Doe
                        <small class="contacts-list-date float-right">2/23/2015</small>
                      </span>
                      <span class="contacts-list-msg">I will be waiting for...</span>
                    </div>
                    <!-- /.contacts-list-info -->
                  </a>
                </li>
                <!-- End Contact Item -->
                <li>
                  <a href="#">
                    <img class="contacts-list-img" src="dist/img/user3-128x128.jpg">

                    <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        Nadia Jolie
                        <small class="contacts-list-date float-right">2/20/2015</small>
                      </span>
                      <span class="contacts-list-msg">I'll call you back at...</span>
                    </div>
                    <!-- /.contacts-list-info -->
                  </a>
                </li>
                <!-- End Contact Item -->
                <li>
                  <a href="#">
                    <img class="contacts-list-img" src="dist/img/user5-128x128.jpg">

                    <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        Nora S. Vans
                        <small class="contacts-list-date float-right">2/10/2015</small>
                      </span>
                      <span class="contacts-list-msg">Where is your new...</span>
                    </div>
                    <!-- /.contacts-list-info -->
                  </a>
                </li>
                <!-- End Contact Item -->
                <li>
                  <a href="#">
                    <img class="contacts-list-img" src="dist/img/user6-128x128.jpg">

                    <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        John K.
                        <small class="contacts-list-date float-right">1/27/2015</small>
                      </span>
                      <span class="contacts-list-msg">Can I take a look at...</span>
                    </div>
                    <!-- /.contacts-list-info -->
                  </a>
                </li>
                <!-- End Contact Item -->
                <li>
                  <a href="#">
                    <img class="contacts-list-img" src="dist/img/user8-128x128.jpg">

                    <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        Kenneth M.
                        <small class="contacts-list-date float-right">1/4/2015</small>
                      </span>
                      <span class="contacts-list-msg">Never mind I found...</span>
                    </div>
                    <!-- /.contacts-list-info -->
                  </a>
                </li>
                <!-- End Contact Item -->
              </ul>
              <!-- /.contacts-list -->
            </div>
            <!-- /.direct-chat-pane -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer" style="display: block;">
            <form action="#" method="post">
              <div class="input-group">
                <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                <span class="input-group-append">
                  <button type="button" class="btn btn-warning">Send</button>
                </span>
              </div>
            </form>
          </div>
          <!-- /.card-footer-->
        </div>
        <!--/.direct-chat -->
      </div>
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
