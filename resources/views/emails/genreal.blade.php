@component('mail::message')

    {{$message}}

@component('mail::button', ['url' =>'https://roseneri.com/'])
الذهاب الى الموقع
@endcomponent

شكراً,<br>
{{ config('app.name') }}
@endcomponent
