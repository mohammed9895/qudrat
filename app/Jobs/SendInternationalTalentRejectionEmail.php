<?php

namespace App\Jobs;

use App\Mail\InternationalTalentRequestRejected;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendInternationalTalentRejectionEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $name;

    public string $email;

    public ?string $reason;

    public function __construct(string $name, string $email, ?string $reason = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->reason = $reason;
    }

    public function handle(): void
    {
        Mail::to($this->email)->send(new InternationalTalentRequestRejected(
            $this->name,
            $this->email,
            $this->reason
        ));
    }
}
