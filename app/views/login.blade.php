<!doctype html>
<html>
<head>
</head>
<body>
	{{ Form::open(array('url' => 'login')) }}
		<h1>Login</h1>

		@if (Session::get('loginError'))
		<div class="alert alert-danger">{{ Session::get('loginError') }}</div>
		@endif

		<p>
			{{ $errors->first('email') }}
			{{ $errors->first('password') }}
		</p>

		<p>
			{{ Form::label('email', 'Email Address') }}
			{{ Form::text('email', Input::old('email'), array('placeholder' => 'me@example.com')) }}
		</p>

		<p>
			{{ Form::label('password', 'Password') }}
			{{ Form::password('password') }}
		</p>

		<p>{{ Form::submit('Submit!') }}</p>
	{{ Form::close() }}

</body>
</html>
