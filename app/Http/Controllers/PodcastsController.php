<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePodcastRequest;
use App\Modules\Podcast\Actions\CreatePodcast;
use App\Modules\Podcast\DTO\CreatePodcastDTO;
use Illuminate\Support\Facades\Storage;

class PodcastsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function create(CreatePodcastRequest $request, CreatePodcast $action)
    {
        $podcast = $action->execute(CreatePodcastDTO::from([
            'user' => auth()->user(),
            ...$request->all(),
        ]));

        return response()->json([
            'id' => $podcast->id,
        ], 201);
    }
}
