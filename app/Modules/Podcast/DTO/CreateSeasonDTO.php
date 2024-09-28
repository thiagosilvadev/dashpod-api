<?php

namespace App\Modules\Podcast\DTO;

use App\Models\Podcast;
use App\Models\User;
use Spatie\LaravelData\Data;


class CreateSeasonDTO extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly ?int $number,
        public readonly string $slug,
        public readonly ?string $bio,
        public readonly ?string $cover_art_url,
        public readonly Podcast $podcast,
        public readonly User $user,

    ) {}
}
