<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMembershipInviteRequest;
use App\Models\Enums\MembershipRole;
use App\Models\Membership;
use App\Modules\Membership\Actions\CreateAndSendInvite;

final class MembershipController extends Controller
{
    public function createInvite(Membership $membership, CreateMembershipInviteRequest $request, CreateAndSendInvite $action)
    {
        if ($membership->podcast->memberships()->whereRelation('user', 'email', $request->input('email'))->exists()) {
            abort(400, 'Email already exists');
        }

        $action->execute($membership, $request->input('email'), $request->enum('role', MembershipRole::class));

        return response()->noContent(201);
    }
}
