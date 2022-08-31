<?php

namespace App\Models;

use App\Models\Traits\HandleUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class PostingAds extends Model
{
    use HasFactory, HandleUpload;

    protected $fillable = [
        'user_id',
        'package_id',
        'photo',
        'social_media',
        'url',
        'notes',
        'amount',
        'status',
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
