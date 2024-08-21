Hello{{$user->name}},
<br>
your new login password:- <b> {{$user->password_random}} </b>
<br>
Thank You, <br>
{{config('app.name')}}