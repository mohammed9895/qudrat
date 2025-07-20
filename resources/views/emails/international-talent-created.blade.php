<x-mail::message>
    # Hello {{ $name }},

    Your international talent account has been created successfully.

    Here are your login details:

    - **Email:** {{ $email }}
    - **Password:** {{ $password }}

    <x-mail::button :url="url('/user/login')">
        Login to Your Account
    </x-mail::button>

    Please log in and change your password as soon as possible.

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
