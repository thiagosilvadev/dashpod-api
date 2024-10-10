@component('mail::message')
{{$whoIsInviting->user->name}} has invited you to their podcast {{$whoIsInviting->podcast->name}} on Dashpod

@component('mail::button', ['url' => $link])
Accept
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
