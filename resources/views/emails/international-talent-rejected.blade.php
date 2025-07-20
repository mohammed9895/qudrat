<x-mail::message>
    # Hello {{ $name }},

    We regret to inform you that your international talent application has been **rejected**.

    @isset($reason)
        **Reason:**
        {{ $reason }}
    @endisset

    If you believe this was a mistake, feel free to contact our support team.

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
