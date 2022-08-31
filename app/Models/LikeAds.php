<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class LikeAds extends Model
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
    ];

    protected $attributes = [
        'status' => self::PENDING,
    ];

    const PENDING = 'pending';
    const ACTIVE  = 'active';
    const FINISH  = 'finish';

    const COMMISSION = 60;

    public function getSocialMedia(): string
    {
        return Str::ucfirst($this->social_media);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class, 'package_id')->whereNotNull('packages.updated_at');
    }

    public function getCommissionFee()
    {
        return "Rp" . self::COMMISSION . " / Like";
    }

    public function getTicket()
    {
        return $this->amount ?: "Tiket Habis";
    }
}
