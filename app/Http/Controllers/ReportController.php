<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Strip;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reportStrip(Strip $strip, Request $request)
    {
        $request->validate([
            'reported_by' => 'required',
            'reason' => 'required',
        ]);

        if($report = $strip->report([
            'reported_by' => $request->reported_by,
            'reason' => $request->reason,
        ])) {
            return $report;
        }

        abort(400);
    }

    public function index()
    {
        return view('reports',
        [
            'reports' => Report::whereNull('resolved_at')->orderBy('created_at', 'desc')->get(),
        ]);
    }
}
