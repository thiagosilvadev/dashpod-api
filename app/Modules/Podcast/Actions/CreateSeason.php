<?php

namespace App\Modules\Podcast\Actions;

use App\Models\Season;
use App\Modules\Podcast\DTO\CreateSeasonDTO;

final class CreateSeason
{
    public function execute(CreateSeasonDTO $payload): Season
    {
        return Season::create([
            'name' => $payload->name,
            'created_by_user_id' => $payload->user->id,
            'cover_art_url' => $payload->cover_art_url,
            'bio' => $payload->bio,
            'slug' => $payload->slug,
            'number' => $payload->number,
            'podcast_id' => $payload->podcast->id,
            'created_at' => now(),
        ]);
    }
}
