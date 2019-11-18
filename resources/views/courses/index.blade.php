@extends('layouts.app')

@section('styles')
<style>
#add {
  position: fixed; /* Fixed/sticky position */
  bottom: 20px; /* Place the button at the bottom of the page */
  right: 30px; /* Place the button 30px from the right */
  z-index: 99; /* Make sure it does not overlap */
  border: none; /* Remove borders */
  outline: none; /* Remove outline */
  color: white; /* Text color */
  cursor: pointer; /* Add a mouse pointer on hover */
  width: 50px;
  height: 50px;
  border-radius: 50%;
  line-height: 40px;
  text-align: center;
  font-size: 18px; /* Increase font size */
}
#add:hover {
  background-color: #555; /* Add a dark-grey background on hover */
}
</style>
@endsection

@section('content')
<div class="container-fluid row">
    <div class="col-lg-4 col-sm-6">
        <div class="col-md-12">
            <a href="{{ route('courses.create') }}" id="add" class="btn btn-custom"><span class="fa fa-plus"></span></a>
        </div>
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

@section('scripts')
<script>

</script>
@endsection
