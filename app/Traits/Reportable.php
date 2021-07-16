<?php

namespace App\Traits;

use App\Events\StripReported;
use App\Models\Report;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Reportable
{

    public function reports(): MorphMany
    {
        return $this->morphMany(Report::class, 'reportable')->latest();
    }

    public function report($array)
    {
        $report = $this->reports()->create([
            'reason'  => $array['reason'],
            'reported_by' => $array['reported_by'],
        ]);

        event(new StripReported($report));

        return $report;
    }
}
