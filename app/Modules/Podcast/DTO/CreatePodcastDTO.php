<?php

namespace App\Modules\Podcast\DTO;

use App\Models\User;
use Spatie\LaravelData\Data;

class CreatePodcastDTO extends Data
{
    public function __construct(
        public readonly User $user,
        public readonly string $name,
        public readonly ?string $description,
        public readonly ?string $cover_art,
    ) {}
}
