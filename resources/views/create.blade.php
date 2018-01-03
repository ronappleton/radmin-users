@extends(config('radmin-users.layout_file'))

@section('content')
    {!! Form::open(['route' => 'users.store']) !!}
    @include('radmin-users::form')
    <div class="form-group">
        {{ Form::submit('Create User', ['class' => 'btn btn-sm btn-success form-control']) }}
    </div>

    {{ Form::close() }}
    @endsection