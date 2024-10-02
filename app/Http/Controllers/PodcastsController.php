<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePodcastRequest;
use App\Modules\Podcast\Actions\CreatePodcast;
use App\Modules\Podcast\DTO\CreatePodcastDTO;

class PodcastsController extends Controller
{
    public function create(CreatePodcastRequest $request, CreatePodcast $action)
    {
        $podcast = $action->execute(CreatePodcastDTO::from([
            'user' => $request->user(),
            ...$request->all(),
        ]));

        return response()->json([
            'id' => $podcast->id,
        ], 201);
    }

}
