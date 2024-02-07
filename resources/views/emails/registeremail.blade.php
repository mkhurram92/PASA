<x-mail::message>
    # Hello, {{ $name }}

    You have successfully created a {{ $type }}. Your application is now under observation. Once it is approved,
    you will
    receive an email notification.


    Thank you for using our application!,<br>
    {{ config('app.name') }}
</x-mail::message>
