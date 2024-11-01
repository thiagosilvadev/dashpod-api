<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageFileController extends Controller
{
    public function presignedUrl(Request $request)
    {
        $request->validate([
            'ext' => ['string', 'in:jpg,jpeg,png'],
        ]);

        $id = \Str::uuid()->toString();

        return \Storage::disk('podcasts')->temporaryUploadUrl(
            "images/{$id}.{$request->input('ext')}", now()->addMinutes(5)
        );
    }
}
