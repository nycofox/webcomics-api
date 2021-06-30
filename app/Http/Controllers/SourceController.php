<?php

namespace App\Http\Controllers;

use App\Models\Source;
use App\Models\Webcomic;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    public function create(Webcomic $webcomic)
    {
        return view('sources.create', [
            'webcomic' => $webcomic
        ]);
    }

    public function store(Webcomic $webcomic, Request $request)
    {
        $request->validate([
            'homepage' => 'required|url',
            'searchstring' => 'required',
            'scraper' => 'required'
        ]);

        $webcomic->sources()->create([
            'homepage' => $request->homepage,
            'name' => $request->name,
            'searchstring_comic' => $request->searchstring,
            'searchstring_title' => $request->searchstring_title,
            'searchstring_description' => $request->searchstring_description,
            'searchstring_number' => $request->searchstring_number,
            'active' => true,
            'scraper' => $request->scraper,
            'lang' => $request->lang
        ]);

        return redirect(route('webcomics.show', $webcomic));
    }

    public function edit(Webcomic $webcomic, Source $source)
    {
        return view('sources.edit', [
            'webcomic' => $webcomic,
            'source' => $source,
        ]);
    }

    public function update(Webcomic $webcomic, Source $source, Request $request)
    {
        $request->validate([
            'homepage' => 'required|url',
            'searchstring' => 'required',
            'scraper' => 'required'
        ]);

        $source->update([
            'homepage' => $request->homepage,
            'name' => $request->name,
            'searchstring_comic' => $request->searchstring,
            'searchstring_title' => $request->searchstring_title,
            'searchstring_description' => $request->searchstring_description,
            'searchstring_number' => $request->searchstring_number,
            'scraper' => $request->scraper,
            'lang' => $request->lang,
            'active' => (bool)$request->active,
        ]);

        return redirect(route('webcomics.show', $webcomic));
    }

    public function scrape(Webcomic $webcomic, Source $source)
    {
        \Artisan::call('webcomics:scrape', ['source' => $source->id]);

        return \Artisan::output();
    }
}
