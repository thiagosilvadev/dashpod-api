<?php

namespace App\Mail;

use App\Models\Invite;
use App\Models\Membership;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class MembershipInviteMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        private readonly Membership $whoIsInviting,
        private readonly Invite $invite,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "{$this->whoIsInviting->user->name} has invited you to their podcast {$this->whoIsInviting->podcast->name} on Dashpod",
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.membership-invite',
            with: [
                'whoIsInviting' => $this->whoIsInviting,
                'link' => URL::signedRoute('membership.create-invite', [
                    'invite' => $this->invite->id,
                ], $this->invite->expires_at),
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
