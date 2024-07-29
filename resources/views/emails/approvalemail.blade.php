<x-mail::message>
    # Hello, {{ $name }}

    Your account has been approved and successfully created with the email ID {{ $email }}. You can now log in with your credentials..

    Thank you!
    
    {{ config('app.name') }}
</x-mail::message>
