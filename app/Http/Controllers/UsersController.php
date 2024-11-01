<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Modules\User\Actions\CreateUser;
use App\Modules\User\DTO\CreateUserDTO;
use Illuminate\Http\JsonResponse;

final class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register']]);
    }

    /**
     * @return UserResource
     *
     * @noinspection PhpDocSignatureInspection
     */
    public function register(CreateUserRequest $request, CreateUser $action): JsonResponse
    {
        $user = $action->execute(CreateUserDTO::from($request->all()));

        return (new UserResource($user))
            ->response()
            ->setStatusCode(201);
    }

    public function me(): UserResource
    {
        return new UserResource(auth()->user());
    }
}
