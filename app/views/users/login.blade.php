@section('login-form')
    <div class="container">
        <div class="col-md-4 col-md-offset-3">
            <div class="container" style="padding-top: 30px; text-align: justify;">
                <p>This is a demo web application that contains a simple cash flow tracking system.  Users can enter expenses and income, and see a chart of their cashflow change in real time.  I build this application to become familiar with Angular.js and Laravel.
                </p>
		<br/>
		<p>Included features are:</p>
                <ul>
                    <li>User Registration.</li>
                    <li>Password Reset Mechanism.</li>
                    <li>AJAX based CSRF tokens co-operating with Angular.js and Laravel.</li>
                    <li>Multiple Angular.js controllers on one page.</li>
                </ul>
            </div>   
            <div class="container" style="text-align: center;">
                @if(Session::has('message'))
                <p class="alert">{{ Session::get('message') }}</p>
                @endif
            </div>   
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            {{ Form::open(array('url'=>'users/signin', 'class'=>'form-signin')) }}
  
            <h2 class="form-signin-heading">Please Login</h2>

            <p>(You can use guest@example.com / password)</p>
   
            <div class="form-group">
                {{ Form::text('email', null, array('class'=>'form-control input-sm', 'placeholder'=>'Email Address')) }}
            </div>
            <div class="form-group">
                {{ Form::password('password', array('class'=>'form-control input-sm', 'placeholder'=>'Password')) }}
            </div>
   
            {{ Form::submit('Login', array('class'=>'btn btn-large btn-primary btn-block'))}}
            {{ Form::close() }}
            <div style="padding: 4px; text-align:center;">
                <a href="/password/remind">Forgot Password?</a>
            </div>
        </div>
    </div>
@stop
