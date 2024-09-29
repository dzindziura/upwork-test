<?php

namespace App\Listeners;

use App\Events\SubmissionSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogSubmissionSaved implements ShouldQueue
{
    public function handle(SubmissionSaved $event)
    {
        Log::info("Submission saved: Name - {$event->name}, Email - {$event->email}");
    }
}
