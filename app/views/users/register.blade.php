@section('register-form')
    <div class="container">
        <div class="col-md-4 col-md-offset-3">
            {{ Form::open(array('url'=>'users/create', 'class'=>'form-signup')) }}
            <h2 class="form-signup-heading">Please Register</h2>

            <div class="container">
                @if(Session::has('message'))
                <p class="alert">{{ Session::get('message') }}</p>
                @endif
            </div>   
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
   
            <div class="form-group">
                {{ Form::text('firstname', null, array('class'=>'form-control input-sm', 'placeholder'=>'First Name')) }}
            </div>
            <div class="form-group">
                {{ Form::text('lastname', null, array('class'=>'form-control input-sm', 'placeholder'=>'Last Name')) }}
            </div>
            <div class="form-group">
                {{ Form::text('email', null, array('class'=>'form-control input-sm', 'placeholder'=>'Email Address')) }}
            </div>
            <div class="form-group">
                {{ Form::password('password', array('class'=>'form-control input-sm', 'placeholder'=>'Password')) }}
            </div>
            <div class="form-group">
                {{ Form::password('password_confirmation', array('class'=>'form-control input-sm', 'placeholder'=>'Confirm Password')) }}
            </div>
   
            {{ Form::submit('Register', array('class'=>'btn btn-large btn-primary btn-block'))}}
            {{ Form::close() }}
            </div>
        </div>
@stop
