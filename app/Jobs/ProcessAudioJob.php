<?php

namespace App\Jobs;

use App\Models\Episode;
use App\Modules\Audio\Lambda\ProcessAudioLambda;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessAudioJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly Episode $episode)//
    {}

    public function handle(ProcessAudioLambda $audioLambda): void {
        $audioLambda->invoke($this->episode);
    }
}
