<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSeasonRequest;
use App\Models\Membership;
use App\Modules\Podcast\Actions\CreateSeason;
use App\Modules\Podcast\DTO\CreateSeasonDTO;
use Illuminate\Http\JsonResponse;

class SeasonsController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function create(CreateSeasonRequest $request, Membership $membership, CreateSeason $action)
    {
        $season = $action->execute(CreateSeasonDTO::from([
            ...$request->all(),
            'podcast' => $membership->podcast,
            'user' => $membership->user,
        ]));

        return response()->json([
            'id' => $season->id,
        ], 201);
    }
}
