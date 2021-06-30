<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Strip extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $appends = ['url'];

    public function source(): BelongsTo
    {
        return $this->belongsTo(Source::class);
    }

    public function getUrlAttribute(): string
    {
        return Storage::temporaryUrl($this->image_path, now()->addMinute());
    }

    public function storeStrip(Source $source, $date)
    {

    }
}
