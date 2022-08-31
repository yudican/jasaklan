<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'label',
        'type',
        'price',
        'benefits',
        'commission',
        'ads_type_id',
        'updated_at'
    ];

    const FOLLOWER   = "follower";
    const COMMENT    = "comment";
    const SUBSCRIBE  = "subscribe";
    const LIKE       = "like";
    const POSTING    = "posting";
    const VIEWS      = "views";
    const SHARE      = "share";

    public function getNameAttribute(): string
    {
        return Str::ucfirst($this->attributes['name']);
    }

    public function getPackageName(): string
    {
        return (new Transaction())->getFormattedPrice($this->price) . ' - ' . $this->benefits . ' ' . $this->label;
    }

    /**
     * Get the adsType that owns the Package
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adsType()
    {
        return $this->belongsTo(AdsType::class);
    }
}
