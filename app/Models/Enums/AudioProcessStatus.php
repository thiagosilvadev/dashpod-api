<?php

namespace App\Models\Enums;

enum AudioProcessStatus: string
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case FAILED = 'failed';
    case COMPLETED = 'completed';
}
