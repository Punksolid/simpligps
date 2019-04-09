@component('mail::message')
# Welcome {{ $user->email }}

You've been invited to use TRM System.
Set a password to enter.

@component('mail::button', ['url' => $url])
Start Using TRM
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
