<?php

namespace App\Models;

use App\Models\Enums\MembershipRole;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Membership extends Model
{
    use HasUuids, Notifiable;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'role' => MembershipRole::class,
    ];

    public function podcast(): BelongsTo
    {
        return $this->belongsTo(Podcast::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
