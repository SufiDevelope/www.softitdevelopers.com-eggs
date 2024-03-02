@component('mail::message')

<p>Hello {{$user->first_name}}</p>

@component('mail::button',['url'=> url('verify/'.$user->remember_token)])
Verify
@endcomponent

<p>In case of any issue you can reach our website contact us form and leave us a message. Our team will contact you soon.</p>

Thanks <br />
{{ config('app.name')}}

@endcomponent