<?php

namespace App\Models;

use App\Models\Concerns\Filterable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;

class LocalJob extends Model
{
    use HasFactory, Sluggable, Filterable;

    protected $casts = [
        'props' => 'json',
        'deadline' => 'date',
    ];

    protected $guarded = [];

    protected static string $generateSlugFromField = 'name';

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($localJob) {
            self::clearCache();
        });

        static::updated(function ($localJob) {
            self::clearCache();
        });

        static::deleted(function ($localJob) {
            self::clearCache();
        });
    }

    protected static function clearCache(): void
    {
        Cache::tags('local_jobs')->flush();
    }
}
