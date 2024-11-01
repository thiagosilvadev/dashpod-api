<?php

namespace App\Http\Controllers;

class AudioFileController extends Controller
{
    public function presignedUrl()
    {
        $id = \Str::uuid()->toString();

        return \Storage::disk('podcasts')->temporaryUploadUrl(
            "audio/{$id}.mp3", now()->addMinutes(5)
        );
    }
}
