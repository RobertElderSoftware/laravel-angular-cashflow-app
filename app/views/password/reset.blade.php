{{{ Session::get('error') }}}
<form action="{{ action('RemindersController@postReset') }}" method="POST">
    <input type="hidden" name="token" value="{{ $token }}">
    Email <input type="email" name="email">
    New Password <input type="password" name="password">
    New Password (again) <input type="password" name="password_confirmation">
    <input type="submit" value="Reset Password">
</form>
