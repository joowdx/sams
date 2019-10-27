@extends('layouts.app')

@section('content')
<div class="container-fluid row">
    <div class="col-lg-4 col-sm-6">
        <div id="logs">
            @foreach ($courses as $course)
                <div class="media text-muted pt-3">
                    <p class="media-body pb-3 mb-0 small lh-125">
                        {{-- <span class="float-right badge badge-{{ $log->remarks=='ok'?'success':'danger' }}"> {{ $log->remarks }} </span> --}}
                        <strong class="d-block text-gray-dark">
                            <a href="{{ route('courses.show', $course->id) }}" class="text-muted" style="text-decoration:none">
                                {{ $course->code }} ⁠— {{ $course->title }}
                            </a>
                        </strong>
                        {{ $course->description }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
