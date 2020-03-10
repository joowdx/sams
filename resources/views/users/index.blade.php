@extends('layouts.app')

@section('styles')
<style>
</style>
@endsection

@section('content')
<div class="col-md-12">
    <a href="{{ route('users.create') }}" id="add" class="btn btn-primary"><span class="fa fa-plus"></span></a>
</div>
<div class="p-2" style="display: block;">
    <table class="table table-borderless table-hover projects">
        <thead>
            <tr>
                <th>
                    <i class="fad fa-hashtag"></i>
                </th>
                <th>
                    Name
                </th>
                <th>
                    Type
                </th>
                <th>
                    Modified
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr onclick="window.location='{{ route('users.show', [$user->id]) }}'" style="cursor: pointer">
                <td class="align-middle">
                    {{ $loop->iteration }}
                </td>
                <td class="align-middle">
                    <small>{{ '@'.$user->username }}</small>
                    <br>
                    <b>{{ $user->name }}</b>
                </td>
                <td class="align-middle">
                    <b>{{ ucfirst($user->type) }}</b>
                </td>
                <td class="align-middle">
                    <small>
                        {{ $user->created_at == $user->updated_at ? 'Created' : 'Updated' }}
                    </small>

                    <br>
                    {{ $user->updated_at->format('F d, Y H:i') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>

</script>
@endsection
