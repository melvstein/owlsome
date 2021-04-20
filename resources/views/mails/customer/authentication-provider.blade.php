@component('mail::message')
<b>Go to your Owlsome Account "Profile" and change your password.</b>
<p>Your generated Current Password is "{{ $generatedPassword }}"</p>

@component('mail::button', ['url' => route('customer.profile')])
Change Password Now
@endcomponent

Thank You,<br>
{{ config('app.name') }}
@endcomponent
