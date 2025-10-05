<?php

namespace App\Livewire\Frontend\Contact;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;

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
        'phone' => 'nullable|numeric',
        'message' => 'required|string',
    ];

    public function submit()
    {
        $validated = $this->validate();

        Mail::to($this->email)->send(
            new ContactMessage(
                $this->name,
                $this->email,
                $this->phone,
                $this->subject,
                $this->message
            )
        );


        session()->flash('success', __('general.contact.thank-you'));

        // Reset form
        $this->reset(['name', 'email', 'subject', 'phone', 'message']);
    }

    public function render()
    {
        return view('livewire.frontend.contact.index');
    }
}
