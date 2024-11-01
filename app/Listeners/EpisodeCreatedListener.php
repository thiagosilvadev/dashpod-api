<?php

namespace App\Listeners;

use App\Events\EpisodeCreatedEvent;
use App\Jobs\ProcessAudioJob;

class EpisodeCreatedListener
{
    public function handle(EpisodeCreatedEvent $event): void
    {
        ProcessAudioJob::dispatch($event->episode);
    }
}
