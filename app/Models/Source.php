<?php

namespace App\Models;

use App\Traits\HasActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Source extends Model
{
    use HasFactory, HasActivity;

    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'last_scraped_at' => 'datetime',
    ];

    protected $withCount = [
        'strips'
    ];

    public function webcomic(): BelongsTo
    {
        return $this->belongsTo(Webcomic::class);
    }

    public function strips(): HasMany
    {
        return $this->hasMany(Strip::class);
    }

    public function getLanguageAttribute(): string
    {
        return $this->locales()[$this->lang] ?? 'Unknown';
    }

    public function getDomainAttribute(): string
    {
        return parse_url($this->homepage, PHP_URL_HOST);
    }

    public function getLocalesAttribute(): array
    {
        return $this->locales();
    }

    private function locales(): array
    {
        return [
            'nb' => 'Norwegian',
            'en' => 'English',
            'sv' => 'Swedish'
        ];
    }

    public function getScrapersAttribute(): array
    {
        return $this->scrapers();
    }

    private function scrapers(): array
    {
        return [
            'App\Scrapers\SearchScraper' => 'Search',
            'App\Scrapers\GenerateScraper' => 'Generate',
        ];
    }

}
