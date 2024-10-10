<?php

namespace App\Modules\Membership\Actions;

use App\Mail\MembershipInviteMail;
use App\Models\Enums\MembershipRole;
use App\Models\Invite;
use App\Models\Membership;
use Illuminate\Support\Facades\Mail;

class CreateAndSendInvite
{
    public function execute(Membership $whoIsInviting, string $email, MembershipRole $role): void
    {
        $invite = Invite::create([
            'email' => $email,
            'role' => $role,
            'invited_by_membership_id' => $whoIsInviting->id,
            'expires_at' => now()->addDays(7),
        ]);

        Mail::to($email)->send(new MembershipInviteMail($whoIsInviting, $invite));

    }
}
