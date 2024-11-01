<?php

namespace App\Jobs;

use App\Models\Episode;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Audio\TranscriptionResponseSegment;

class TranscribeEpisodeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly Episode $episode) {}

    public function handle(): void
    {
        $transcription = OpenAI::audio()->transcribe([
            'model' => 'whisper-1',
            'file' => \Storage::disk('podcasts')->readStream($this->episode->audio_url),
            'response_format' => 'verbose_json',
            'timestamp_granularities' => ['segment', 'word'],
        ]);

        $payload = collect($transcription->segments)->map(function (TranscriptionResponseSegment $segment) {
            return [
                'text' => $segment->text,
                'start' => $segment->start,
                'end' => $segment->end,
                'episode_id' => $this->episode->id,
            ];
        })->toArray();

        $this->episode->insert($payload);

        //socket communication
    }
}
