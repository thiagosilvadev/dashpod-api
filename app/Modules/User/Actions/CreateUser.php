<?php

namespace App\Modules\User\Actions;

use App\Models\User;
use App\Modules\User\DTO\CreateUserDTO;
use Hash;

final class CreateUser
{
    public function __construct(

    ) {}

    public function execute(CreateUserDTO $payload): User
    {
        return User::create([
            ...$payload->except('password')->toArray(),
            'password' => Hash::make($payload->password),
        ]);
    }
}
