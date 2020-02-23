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

        @can('aview', App\User::class)
        <div id="circularMenu" class="circular-menu">

            <a class="floating-btn" onclick="document.getElementById('circularMenu').classList.toggle('active');">
                <i class="fa fa-bars" style="color:white"></i>
            </a>

            <menu class="items-wrapper">

            <a href="users/{{Auth::user()->id}}/edit" class="menu-item">
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

        <div class="col-md-12">
            <img src="{{ asset('img.jpg') }}" class="img-fluid" alt="Responsive image" style="position:absolute;"/>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12" style="margin-top:20%; padding-right:10%; padding-left:10%">
            <div class="card" style="border:10%">
                <div class="col-md-12 col-sm-8">
                    <h2>{{ Auth::user()->name }}</h2>
                    <p><i class="nav-icon fad fa-user-visor fa-fw"></i><strong>Username: {{Auth::user()->username}} </strong>  </p>
                    <p><i class="nav-icon fad fa-envelope-square fa-fw"></i><strong>Email: {{Auth::user()->email}} </strong>  </p>
                    <p><i class="nav-icon fad fa-phone-square-alt fa-fw"></i><strong>Phone Number: {{Auth::user()->phone }} </strong> </p>
                    <p><strong></strong>
                    <span class="tags"> {{Auth::user()->type }} </span>
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
$('.btn-delete').click(function(e){
    swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $('#deleteform').submit()
        }
    })
    e.preventDefault()
})
</script>
@endsection
