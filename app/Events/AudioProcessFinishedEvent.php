<?php

namespace App\Events;

use App\Models\Enums\AudioProcessStatus;
use App\Models\Episode;
use Illuminate\Foundation\Events\Dispatchable;

class AudioProcessFinishedEvent
{
    use Dispatchable;

    public function __construct(public Episode $episode, public AudioProcessStatus $status)
    {
    }

}
