@component('mail::message')
<h1>Hello {{$name}}</h1>

You are receiving this email because we have received a password reset request for your account.

@component('mail::button',  ['url' => $resetUrl])
Reset password
@endcomponent

This link to reset your password will expire in 60 minutes.

If you didn't request a password reset, you don't need to do anything else.
<p>
Yours sincerely, <br/>
{{ config('app.name') }}
</p>
@endcomponent