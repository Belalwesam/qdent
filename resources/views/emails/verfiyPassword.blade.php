@component('mail::message')

   {{__('Hello,')}} {{$user->name}}
    {{__('Your  Code for reset password  is: ')}} {{$user->code}}
@component('mail::button', ['url' =>'http://app.swipyy.com'])
@endcomponent
   {{__('Thanks')}}
   <br>

   {{ config('app.name') }}
@endcomponent
