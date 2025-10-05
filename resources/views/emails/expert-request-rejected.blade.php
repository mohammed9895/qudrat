<x-mail::message>
# Update on Your Expert Request, {{ $name }}

We reviewed your request, and unfortunately it was **not approved** at this time.


@isset($message)
<x-mail::panel>
**Message provided:**  
{{ $message }}
</x-mail::panel>
@endisset

If you believe additional information could help, you may revise and resubmit.

Thanks,  
{{ config('app.name') }}
</x-mail::message>
