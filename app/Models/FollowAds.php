<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class FollowAds extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'title',
        'social_media',
        'url',
        'account_name',
        'notes',
        'amount',
    ];

    protected $attributes = [
        'status' => self::PENDING,
    ];

    const PENDING = 'pending';
    const ACTIVE  = 'active';
    const FINISH  = 'finish';

    public function getSocialMedia(): string
    {
        return Str::ucfirst($this->social_media);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class, 'package_id')->whereNotNull('packages.updated_at');
    }
}
