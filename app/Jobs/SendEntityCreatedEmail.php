<?php

namespace App\Jobs;

use App\Mail\EntityAccountCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendEntityCreatedEmail implements ShouldQueue
{
    use Queueable;

    protected string $name;

    protected string $email;

    protected string $password;

    public function __construct(string $name, string $email, string $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function handle(): void
    {
        $loginUrl = route('filament.entity.auth.login'); // Adjust as needed
        Mail::to($this->email)->send(
            new EntityAccountCreated($this->name, $this->email, $this->password, $loginUrl)
        );
    }
}
