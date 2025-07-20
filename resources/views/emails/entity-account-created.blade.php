<x-mail::message>
    # Welcome to {{ config('app.name') }}, {{ $name }}

    Your account has been successfully created.

    Here are your login credentials:

    **Email:** {{ $email }}
    **Password:** {{ $password }}

    <x-mail::button :url="$loginUrl">
        Login Now
    </x-mail::button>

    Make sure to change your password after logging in for the first time.

    Thanks,
    {{ config('app.name') }}
</x-mail::message>
