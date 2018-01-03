@extends(config('radmin-users.layout_file'))

@section('content')
    {{ Form::model($model, ['route' => ['users.update', $model], 'method' => 'PUT']) }}
    @include('radmin-users::form')
    <div class="form-group">
        {{ Form::submit('Change User', ['class' => 'btn btn-sm btn-success form-control']) }}
    </div>
    {{ Form::close() }}
@endsection