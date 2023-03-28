<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MediaService
{
    /**
     * Default constructor to load data and view
     * @param Media $media
     */
    public function __construct(
        protected Media $media
    ) {
    }

    /**
     * Store a new resource
     *
     * @param Request $request
     * @return object
     */
    public function store(Request $request)
    {
        $file = $request->file('media');
        if ($file) {
            $extention = 'webp';
            $hash = hash('sha256', Str::uuid()->toString());
            $url = "medias/{$hash}.{$extention}";
            Storage::disk('public')->put($url, file_get_contents($file));

            return $this->media->create([
                'url' => $url,
                'hash' => $hash,
                'extention' => $extention,
                'size' => $file->getSize(),
                'name' => $file->getClientOriginalName(),
            ]);
        }

        return [];
    }
}
