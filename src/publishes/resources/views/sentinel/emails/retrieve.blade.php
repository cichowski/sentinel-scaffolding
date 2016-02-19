Welcome {{ $user->first_name }} {{ $user->last_name }},<br />
<br />
Your login: {{ $user->username }}<br />
<br />
To set a new password 
<a href="{{ route('auth.restore', [$reminder->user_id, $reminder->code]) }}">click here</a><br />
<br />
Please ignore this message if You have not intended to set a new password for Your account on {{ env('APP_URL') }}.



