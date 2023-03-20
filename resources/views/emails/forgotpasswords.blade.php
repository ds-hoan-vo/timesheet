<x-mail::message>
# {{ config('app.name') }} - Forgot Password

Hello {{ $email }},

Your otp is {{ $otp }} will be expired for 60 seconds .

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
