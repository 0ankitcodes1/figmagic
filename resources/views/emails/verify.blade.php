@component('mail::message')
# Email Verification

Hey, you're almost ready to start enjoying Nizeed.
Here is the your <strong>6-digits</strong> verification code. Please verify your email as soon as possible.

<br />

@php
     $token_array = str_split($email_token);
     foreach($token_array as $digit) {
          echo "<span style='padding:.5rem; background-color:rgb(50, 50, 50); color: #fff; margin: .5rem; border-radius: .2rem;'>".$digit."</span>";
     }
@endphp

<br />
<br />

Click <strong>Verify Now</strong> Button and enter above <strong>6-digits</strong> code to get verified.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/login'])
Veryfy Now
@endcomponent

Thank You,<br />
{{ config('app.name') }}
@endcomponent
