<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ViewAds extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'social_media',
        'url',
        'status',
        'views',
        'amount',
        'notes',
    ];

    protected $attributes = [
        'status' => self::PENDING,
        'social_media' => 'Youtube',
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
        return $this->belongsTo(Package::class, 'package_id')->whereNotNull('updated_at');
    }

    public function getTotalPayment()
    {
        return $this->package()->first()->price * $this->views;
    }
}
