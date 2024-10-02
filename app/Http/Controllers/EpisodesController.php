<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEpisodeRequest;
use App\Models\Membership;
use App\Modules\Podcast\Actions\CreateEpisode;
use App\Modules\Podcast\DTO\CreateEpisodeDTO;

final class EpisodesController extends Controller
{
    public function create(CreateEpisodeRequest $request, CreateEpisode $action, Membership $membership)
    {
        $episode = $action->execute(CreateEpisodeDTO::from([
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'description' => $request->get('description'),
            'coverUrl' => $request->get('cover_url'),
            'audioUrl' => $request->get('audio_url'),
            'seasonId' => $request->get('season_id'),
            'podcast' => $membership->podcast,
            'createdBy' => $membership->user,
        ]));

        return response()->json([
            'id' => $episode->id,
        ], 201);
    }
}
