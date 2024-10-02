<?php

namespace App\Modules\Podcast\DTO;

use App\Models\Podcast;
use App\Models\User;
use Spatie\LaravelData\Data;

class CreateEpisodeDTO extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $slug,
        public readonly ?string $description,
        public readonly ?string $coverUrl,
        public readonly ?string $audioUrl,
        public readonly ?string $seasonId,
        public readonly Podcast $podcast,
        public readonly User $createdBy,
    ) {}

}
