<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShortenedUrl;
use App\Models\ShortenedUrl;
use Illuminate\Support\Str;


class ShortenedUrlController extends Controller
{
    public function generateShortenedUrl(StoreShortenedUrl $request)
    {
        $url = $request->validated()['url'];

        $shortenedUrl = ShortenedUrl::create([
            'url' => $url,
            'code' => $this->generateUniqueCode()
        ]);

        return true;
    }

    private function generateUniqueCode()
    {
        do {
            $code = Str::random(6);
        } while (ShortenedUrl::whereCode($code)->exists());

        return $code;
    }
}
