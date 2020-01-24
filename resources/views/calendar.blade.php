@extends('layouts.app')

@section('styles')
<style>
.fc-sat, .fc-sun { color: #dc3233;  }
</style>
@endsection

@section('content')
<div id="calendar" class="col-md-6"></div>
@endsection

@section('scripts')
<script>
$(() => {
    var calendar = new Calendar(document.getElementById('calendar'), {
        plugins: [ interactionPlugin,dayGridPlugin ],
        firstDay: 1,
        header: {
            left: 'title',
            right: 'prevYear,prev,today,next,nextYear'
        },
        selectable: true,
        displayEventTime: false,
        googleCalendarApiKey: 'AIzaSyCLu3aNS-LE7sAgndn4p_gGYNZ_NhvE0us',
        events: 'https://en.philippines#holiday@group.v.calendar.google.com',
    })
    calendar.render()
})

</script>
@endsection
