<?php

namespace App\Modules\Podcast\Actions;

use App\Models\Enums\MembershipRole;
use App\Models\Podcast;
use App\Modules\Podcast\DTO\CreatePodcastDTO;
use Illuminate\Support\Facades\DB;

final class CreatePodcast
{
    public function execute(CreatePodcastDTO $payload): Podcast
    {

        return DB::transaction(function () use ($payload) {
            $podcast = Podcast::create([
                'name' => $payload->name,
                'description' => $payload->description,
                'cover_art' => $payload->cover_art,
                'created_at' => now(),
                'created_by_user_id' => $payload->user->id,
            ]);

            $podcast->memberships()->create([
                'user_id' => $payload->user->id,
                'role' => MembershipRole::ADMIN,
            ]);

            return $podcast;
        });

    }
}
