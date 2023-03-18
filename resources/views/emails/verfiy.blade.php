@component('mail::message')

   {{__('Hello,')}} {{$user->name}}
    {{__('Your Activation Code is: ')}} {{$user->code}}
   <br>
   or
   <br>
   @component('mail::button', ['url' =>'http://app.swipyy.com/verfiy/user?token='.$user->verfiyUrl(),'text'=>"Verify"])
       Verify
   @endcomponent
   {{__('Thanks')}}
   <br>

   {{ config('app.name') }}

@endcomponent

