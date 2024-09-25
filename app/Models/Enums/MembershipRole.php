<?php

namespace App\Models\Enums;

enum MembershipRole: string
{
    case ADMIN = 'admin';
    case DEVELOPER = 'developer';
    case EDITOR = 'editor';
}
