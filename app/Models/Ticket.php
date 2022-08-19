<?php

namespace App\Models;

use App\Models\Traits\HandleUpload;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //use Uuid;
    use HasFactory, HandleUpload;

    //public $incrementing = false;

    protected $fillable = ['account_name', 'ads_id', 'commission', 'name', 'screenshot', 'screenshot_akhir', 'status', 'user_id'];

    protected $dates = [];

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

    /**
     * Get the user that owns the Ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
