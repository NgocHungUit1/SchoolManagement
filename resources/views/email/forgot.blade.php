@component('mail::message')
    Hello {{ $user->name }},
    <p>We understand</p>
    @component('mail::button', ['url' => url('reset/' . $user->remember_token)])
        Reset your Password
    @endcomponent
    <p>123123123123123</p>
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
