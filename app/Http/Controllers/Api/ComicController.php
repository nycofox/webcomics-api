<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Strip;
use App\Models\Webcomic;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Validator;

class ComicController extends Controller
{

    public function show(Strip $strip)
    {
        return $strip;
    }

    public function strips($date = null): array
    {
        if (!$date = $this->setDate($date)) {
            abort(422, 'Invalid date.');
        }

        $strips = Strip::where('date', $date->format('Y-m-d'))
            ->with('source')
            ->with('source.webcomic')
            ->get()
            ->sortBy(function ($q) {
                return $q->source->webcomic->name;
            })
            ->groupBy(function ($q) {
                return $q->source->webcomic->name;
            });

        return [
            'date' => $date,
            'number_of_strips' => $strips->count(),
            'strips' => $strips->toArray(),
        ];
    }

    public function webcomics()
    {
        $webcomics = Webcomic::orderBy('name')->with('sources')->get();

        return [
            'number_of_webcomics' => $webcomics->count(),
            'webcomics' => $webcomics,
        ];
    }

    /**
     * Validates or sets date
     *
     * @param null $date
     * @return Carbon|null
     */
    private function setDate($date = null): ?Carbon
    {

        /*
         * If no date, set to today
         */
        if (!$date) {
            return Carbon::now();
        }

        /*
         * If date looks completely weird, return null
         */
        if(!strtotime($date) ) {
            return null;
        }

        /*
         * Parse date, return null if invalid
         */
        if (!Carbon::createFromFormat('Y-m-d', $date)) {
            return null;
        }

        /*
         * If date is in the future, return null
         */
        if (Carbon::createFromFormat('Y-m-d', $date)->isFuture()) {
            return null;
        }

        /*
         * If valid date, return Carbon instance of date
         */
        return Carbon::createFromFormat('Y-m-d', $date);

    }

}
