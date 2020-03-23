@component('mail::message')
# Welcome {{ $user->email }}

You've been invited to use SimpliGPS.
Set a password to enter.

@component('mail::button', ['url' => $url])
Start Using SimpliGps
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
