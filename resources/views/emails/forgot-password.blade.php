@component('mail::message')
# Forgot Password

Click below to reset your password

@component('mail::button', ['url' => 'https://figmaapp.herokuapp.com/forgot-password?token='.$token])
Reset Password
@endcomponent

@endcomponent
