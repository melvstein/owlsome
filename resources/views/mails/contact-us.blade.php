@component('mail::message')
<h1>{{ $details['subject'] }}</h1>
<p>From: {{ $details['email'] }}</p>
<p>Name: {{ $details['name'] }}</p>
<p>Contact Number: {{ $details['contactNumber'] }}</p>
<p>Message:</p>
<p>{{ $details['message'] }}</p>

Thanks,<br>
{{ $details['name'] }}
@endcomponent
