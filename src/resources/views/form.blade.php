<div class="input-group {{ $errors->has('name') ? 'has-error' : '' }}">
											<i class="material-icons">face</i>
    {{ Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Name...']) }}
    @if ($errors->has('name'))
        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
    @endif
</div>

<div class="input-group {{ $errors->has('email') ? 'has-error' : '' }}">
											<i class="material-icons">email</i>
    {{ Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Email...']) }}
    @if ($errors->has('email'))
        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
    @endif
</div>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">