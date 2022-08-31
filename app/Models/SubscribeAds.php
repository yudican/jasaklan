<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class SubscribeAds extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'title',
        'social_media',
        'url',
        'status',
        'amount',
        'notes',
    ];

    protected $attributes = [
        'status' => self::PENDING,
    ];

    const PENDING = 'pending';
    const ACTIVE  = 'active';
    const FINISH  = 'finish';

    const COMMISSION = 200;

    public function getSocialMedia(): string
    {
        return Str::ucfirst($this->social_media);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class, 'package_id')->whereNotNull('updated_at');
    }

    public function getCommisionFee()
    {
        return "Rp" . self::COMMISSION . " / Subscribe";
    }

    public function getTicket()
    {
        return $this->amount ?: "Tiket Habis";
    }
}
