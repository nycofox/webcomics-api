<?php

namespace App\Http\Controllers;

use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'source' => '', // Todo: Must be a valid source
            'date' => 'required|date',
            'file' => 'required|mimes:jpeg,png,gif,webp',
        ]);

        $source = Source::find($request->source);

        $file = $request->file('file');

        $path = 'webcomics/' . $source->webcomic->id . Str::random(30) . '.' . basename($file->getMimeType());

        $file->storeAs($path);

        $strip = $source->strips()->create([
            'image_path' => $path,
            'image_hash' => md5($file->body()),
            'image_filesize' => 0,
            'date' => $request->date,
        ]);

        // Todo: Return status of upload

        return redirect()->back();
    }
}
