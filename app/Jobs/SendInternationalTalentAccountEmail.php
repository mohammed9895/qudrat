<?php

namespace App\Jobs;

use App\Mail\InternationalTalentAccountCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendInternationalTalentAccountEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $name;

    public string $email;

    public string $password;

    public function __construct(string $name, string $email, string $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function handle(): void
    {
        Mail::to($this->email)->send(new InternationalTalentAccountCreated(
            $this->name,
            $this->email,
            $this->password,
        ));
    }
}
