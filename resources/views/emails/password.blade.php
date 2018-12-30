@component('mail::message')
# Welcome

You have been successfully registered on our system. your password is {{ $password }}

@component('mail::button', ['url' => 'http://127.0.0.1:8000'])
Continue
@endcomponent

@component('mail::panel', ['url' => ''])
<p><i>You can make your own password after login using this password</p>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
