<?php

namespace App\Modules\User\DTO;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;

class CreateUserDTO extends Data
{
    public function __construct(
        #[Min(5), Max(200)]
        public readonly string $name,
        #[Email]
        public readonly string $email,
        #[Min(4), Max(50)]
        public readonly string $password,
    ) {}
}
