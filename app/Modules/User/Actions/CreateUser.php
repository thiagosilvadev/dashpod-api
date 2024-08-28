<?php

namespace App\Modules\User\Actions;

use App\Models\User;
use App\Modules\User\DTO\CreateUserDTO;
use Hash;

final class CreateUser
{
    public function __construct(
        private readonly CreateUserDTO $payload
    ) {}

    public function execute(): User
    {
        return User::create([
            ...$this->payload->except('password')->toArray(),
            'password' => Hash::make($this->payload->password),
        ]);
    }
}
