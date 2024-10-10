<?php

namespace App\Models;

use App\Models\Enums\MembershipRole;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invite extends Model
{
    use HasUuids;

    protected $casts = [
        'role' => MembershipRole::class,
    ];
    
    public function invitedByMembership(): BelongsTo
    {
        return $this->belongsTo(Membership::class, 'invited_by_membership_id');
    }
}
