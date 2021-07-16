<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'resolved_at' => 'datetime',
    ];

    public function reportable()
    {
        return $this->morphTo();
    }
}
