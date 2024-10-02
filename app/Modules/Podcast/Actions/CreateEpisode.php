<?php

namespace App\Modules\Podcast\Actions;

use App\Models\Episode;
use App\Modules\Podcast\DTO\CreateEpisodeDTO;

final class CreateEpisode
{
    public function execute(CreateEpisodeDTO $payload): Episode
    {
        return Episode::create([
            'name' => $payload->name,
            'description' => $payload->description,
            'slug' => $payload->slug,
            'audio_url' => $payload->audioUrl,
            'cover_url' => $payload->coverUrl,
            'podcast_id' => $payload->podcast->id,
            'created_by_user_id' => $payload->createdBy->id,
            'season_id' => $payload->seasonId,
            'created_at' => now(),
        ]);
    }
}
