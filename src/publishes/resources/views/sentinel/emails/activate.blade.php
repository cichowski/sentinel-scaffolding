Welcome {{ $user->first_name }} {{ $user->last_name }},<br />
Your account on {{ env('APP_URL') }} was succesfully created.<br />
<br />
Your username: {{ $user->username }}<br />
<br />
Activate your account by clicking 
<a href="{{ route('auth.activate', [$activation->user_id, $activation->code]) }}">here</a><br />
<br />
Please ignore this message if You have not intended to create account on {{ env('APP_URL') }}.



