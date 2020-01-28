@extends('layouts.app')

@section('styles')
<style>


</style>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-2 col-sm-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Legend</h3>

                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fad fa-minus"></i>
                </button>
                </div>
            </div>
            <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="fad fa-circle text-danger float-right"></i>
                    Drop candidate
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="fad fa-circle text-warning float-right"></i>
                    Warning
                    </a>
                </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-10">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">List</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 40px">Code</th>
                <th>Description</th>
                <th>Time</th>
                <th style="width: 40px">Lates</th>
                <th style="width: 40px">Absences</th>
                <th style="width: 40px">Remark</th>
              </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{$course->code}}</td>
                        <td>{{$course->description}}</td>
                        <td>{{$course->time_from}} - {{$course->time_to}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer clearfix">
          <ul class="pagination pagination-sm m-0 float-right">
            <li class="page-item"><a class="page-link" href="#">«</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">»</a></li>
          </ul>
        </div>
      </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
</script>
@endsection
