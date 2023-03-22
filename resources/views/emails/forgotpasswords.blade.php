<x-mail::message>
# {{ config('app.name') }} - Forgot Password
Hello {{ $email }},

Your otp is {{ $otp }} will be expired for 60 seconds .

This link to confirm your otp:<br>
@php $url = url('confirm-otp/'.$token); @endphp
<x-mail::button :url="$url">
Confirm
</x-mail::button>
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
