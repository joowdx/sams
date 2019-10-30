@extends('layouts.app')

@section('styles')
<style>
span.tags
{
    background: #1abc9c;
    border-radius: 2px;
    color: #f5f5f5;
    font-weight: bold;
    padding: 2px 4px;
}
.card {
  /* Add shadows to create the "card" effect */
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  padding: 16px 16px;
}

/* On mouse-over, add a deeper shadow */
.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

/* Add some padding inside the card container */
.container-fluid {
  padding: 2px 16px;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <img src="{{ asset('img.jpg') }}" class="img-fluid" alt="Responsive image" style="position:absolute"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="margin-top:20%; padding-right:10%; padding-left:10%">
            <div class="card" style="border:10%">
                <div class="col-md-12 col-sm-8">
                    <h2>{{ $user->name }}</h2>
                    <p><strong>Username: </strong> {{ $user->username }} </p>
                    <p><strong>Email: </strong> {{ $user->email }} </p>
                    <p><strong>Phone Number: </strong>{{ $user->phone }} </p>
                    <p><strong>Type: </strong>
                        <span class="tags">{{ $user->type }}</span>
                    </p>
                </div>

                <div class="col-md-12 divider text-center">
                    <div class="row">

                        <div class="col-md-6 col-sm-4 emphasis">
                            <a class="btn btn-primary btn-block" href="{{ $user->id }}/edit"><span class="fa fa-edit"></span>Edit Details</a>
                        </div>

                        <div class="col-md-6 col-sm-4 emphasis">
                            <form method="post" action="{{ route('users.destroy', $user->id) }}">
                                @method('DELETE')
                                    @csrf
                                        <button class="btn btn-danger btn-block" type="submit" onclick="confirm()"><span class="fa fa-trash"></span>Delete</button>
                            </form>
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

</script>
@endsection
