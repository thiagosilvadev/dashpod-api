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
        $this->middleware('auth:sanctum');
    }

    /**
     *
     * @param CreateUserRequest $request
     * @return UserResource
     *
     * @noinspection PhpDocSignatureInspection
     */
    public function register(CreateUserRequest $request): JsonResponse
    {
        $user = (new CreateUser(CreateUserDTO::from($request->all())))->execute();

        return (new UserResource($user))
            ->response()
            ->setStatusCode(201);
    }

    public function me(): UserResource
    {
        return new UserResource(auth()->user());
    }
}
