<?php

namespace App\Http\Controllers;

use App\Models\Webcomic;
use Illuminate\Http\Request;

class WebcomicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('webcomics.index', [
            'webcomics' => Webcomic::orderBy('name')
                ->withCount('sources')
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('webcomics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3'
        ]);

        Webcomic::create([
            'name' => $request->name,
            'author' => $request->author ?? null,
        ]);

        return redirect(route('webcomics.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Webcomic $webcomic
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Webcomic $webcomic)
    {
        return view('webcomics.show', [
            'webcomic' => $webcomic,
            'sources' => $webcomic->sources,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Webcomic $webcomic
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Webcomic $webcomic)
    {
        return view('webcomics.edit', [
            'webcomic' => $webcomic,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Webcomic $webcomic
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Webcomic $webcomic)
    {
        $request->validate([
            'name' => 'required|min:3'
        ]);

        $webcomic->update([
            'name' => $request->name,
            'author' => $request->author ?? null,
        ]);

        return redirect(route('webcomics.show', $webcomic));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Webcomic $webcomic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Webcomic $webcomic)
    {
        //
    }

    public function scrapeAll()
    {
        \Artisan::call('webcomics:scrapeall');

        return \Artisan::output();
    }
}
