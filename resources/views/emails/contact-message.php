<x-mail::message>
# New Contact Message

You have received a new message through the contact form.

**Name:** {{ $name }}  
**Email:** {{ $email }}  
**Phone:** {{ $phone ?: '—' }}  
**Subject:** {{ $subjectText }}

---

**Message:**

{{ $messageText }}

<x-mail::button :url="config('app.url')">
    Open {{ config('app.name') }}
</x-mail::button>

Thanks,  
{{ config('app.name') }}
</x-mail::message>
