<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortenedUrlRequest;
use App\Models\ShortenedUrl;
use Illuminate\Support\Str;


class ShortenedUrlController extends Controller
{
    public function generateShortenedUrl(ShortenedUrlRequest $request)
    {
        $url = $request->validated()['url'];

        $shortenedUrl = ShortenedUrl::create([
            'url' => $url,
            'code' => $this->generateUniqueCode()
        ]);

        return response()->json([
            'html' => view('ajax.shortener.show_shortened_url', compact('shortenedUrl'))->render()
        ]);
    }

    public function retrieveShortenUrl($code)
    {
        $shortenedUrl = ShortenedUrl::whereCode($code)->firstOrFail();

        return redirect($shortenedUrl->url);
    }

    public function getShortenUrlInfo(ShortenedUrlRequest $request)
    {
        $url = parse_url($request->validated()['url']);

        if (!isset($url['path'])) {
            return response()->json([
                'text' => __('Shortened URL code was not found!')
            ]);
        }

        $explodePath = explode('/', $url['path']);
        array_shift($explodePath);

        $code = $explodePath ? $explodePath[0] : null;

        $shortenedUrl = ShortenedUrl::withoutEvents(function () use ($code) {
            return ShortenedUrl::whereCode($code)->first();
        });

        if (!$shortenedUrl) {
            return response()->json([
                'text' => __('Shortened URL is not valid!')
            ]);
        } else {
            return response()->json([
                'html' => view('ajax.shortener.show_shortened_url_info', compact('shortenedUrl'))->render()
            ]);
        }

    }

    private function generateUniqueCode()
    {
        do {
            $code = Str::random(6);
        } while (ShortenedUrl::whereCode($code)->exists());

        return $code;
    }
}
