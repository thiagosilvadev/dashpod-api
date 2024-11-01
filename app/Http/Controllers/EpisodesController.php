<?php

namespace App\Http\Controllers;

use App\Events\AudioProcessFinishedEvent;
use App\Http\Requests\CreateEpisodeRequest;
use App\Jobs\ProcessAudioJob;
use App\Models\Enums\AudioProcessStatus;
use App\Models\Episode;
use App\Models\Membership;
use App\Modules\Podcast\Actions\CreateEpisode;
use App\Modules\Podcast\DTO\CreateEpisodeDTO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Enum;

final class EpisodesController extends Controller
{
    public function create(CreateEpisodeRequest $request, CreateEpisode $action, Membership $membership)
    {
        if (! Storage::disk('podcasts')->exists($request->get('audio_url'))) {
            abort(400, 'invalid audio file');
        }
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

    public function audioStatus(Request $request, Episode $episode)
    {
        $request->validate([
            'status' => [new Enum(AudioProcessStatus::class)],
        ]);
        event(new AudioProcessFinishedEvent($episode, $request->enum('status', AudioProcessStatus::class)));

        return response()->noContent();
    }
}
