
{{{ Session::get('error') }}}
{{{ Session::get('status') }}}

<form action="{{ action('RemindersController@postRemind') }}" method="POST">
    Enter your email address <input type="email" name="email">
    <input type="submit" value="Send Reminder">
</form>
