<?php

namespace App\Http\Controllers;

use App\Models\Source;
use App\Models\Webcomic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StripController extends Controller
{
    public function index(Webcomic $webcomic, Source $source, $date = null)
    {

    }

    public function store(Webcomic $webcomic, Source $source, Request $request)
    {
        $request->validate([
            'date' => 'date',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg'
        ]);

        $media = $this->storeImage($source, $request->image);

        $strip = $source->strips()->create([
            'image_path' => $media->path,
            'image_hash' => md5_file($request->image),
            'image_filesize' => filesize($request->image),
            'date' => $request->date,
        ]);
    }

    public function destroy()
    {

    }

    private function storeImage(Source $source, Request $request)
    {
        $path = 'webcomics/' . $source->id . '/' . Str::random(30) . '.' . basename($request->image);

        if(!$media = Storage::put($path, $request->image)) {
            return null;
        }

        return $media;
    }
}
