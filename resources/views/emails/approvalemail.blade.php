<x-mail::message>
    # Hello, {{ $name }}

    Your {{ $type }} account has beeen approve and successfully created email id {{ $email }}.
    Now you can login with your credentials.


    Thank you for using our application!,<br>
    {{ config('app.name') }}
</x-mail::message>
