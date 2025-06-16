<?php

namespace App\Livewire\Frontend\Contact;

use Livewire\Component;

class Index extends Component
{
    public $name;

    public $email;

    public $subject;

    public $phone;

    public $message;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'subject' => 'nullable|string|max:255',
        'phone' => 'nullable|numeric|max:20|tel',
        'message' => 'required|string',
    ];

    public function submit()
    {
        $validated = $this->validate();

        // You can send email here or save to database
        // Example: Mail::to('admin@example.com')->send(new ContactMessage($validated));

        session()->flash('success', __('general.contact.thank-you'));

        // Reset form
        $this->reset(['name', 'email', 'subject', 'phone', 'message']);
    }

    public function render()
    {
        return view('livewire.frontend.contact.index');
    }
}
