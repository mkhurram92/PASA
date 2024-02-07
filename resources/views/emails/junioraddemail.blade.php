<x-mail::message>
    # Hello, {{ $name }}

    You have successfully created a Junior with a name {{ $given_name }}.

    Thank you for using our application!,<br>
    {{ config('app.name') }}
</x-mail::message>
