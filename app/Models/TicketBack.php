<?php

namespace App\Models;

use App\Models\Traits\HandleUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory, HandleUpload;

    protected $fillable = [
        'ads_id',
        'user_id',
        'name',
        'account_name',
        'screenshot',
        'screenshot_akhir',
        'commission',
        'status',
    ];

    const REVIEW   = "review";
    const APPROVE  = "approve";
    const REJECTED = "rejected";

    protected $attributes = [
        'status' => self::REVIEW,
    ];

    public function imageAttribute(): string
    {
        return 'screenshot';
    }

    public function getImagePath(): string
    {
        return 'images/tickets/proofs';
    }

    public function getAd()
    {
        return $this->belongsTo(Ads::class, 'ads_id');
    }

    public function getCommission()
    {
        return 'Rp' . number_format($this->commission, 0, ',', '.');
    }

}
