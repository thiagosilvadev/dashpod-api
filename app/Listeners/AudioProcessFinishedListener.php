<?php

namespace App\Listeners;

use App\Events\AudioProcessFinishedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class AudioProcessFinishedListener implements ShouldQueue
{
    public function __construct() {}

    public function handle(AudioProcessFinishedEvent $event): void
    {
        $event->episode->update(['status' => $event->status]);
    }
}
