@component('mail::message')
# Welcome {{ $client->name }},

It's been a great to work with you.

@component('mail::button', ['url' =>''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
