<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Webcomic extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sources(): HasMany
    {
        return $this->hasMany(Source::class);
    }
}
