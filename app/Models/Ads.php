<?php

namespace App\Models;

use App\Models\Traits\HandleUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Ads extends Model
{
    use HasFactory, HandleUpload;

    protected $fillable = [
        'user_id',
        'package_id',
        'title',
        'social_media',
        'type',
        'commission',
        'account_name',
        'photo',
        'url',
        'views',
        'amount',
        'notes',
        'status',
    ];

    protected $attributes = [
        'status' => self::PENDING,
    ];

    const PENDING = 'pending';
    const ACTIVE  = 'active';
    const FINISH  = 'finish';

    const SUBS_COM    = 200;
    const FOLLOW_COM  = 200;
    const LIKE_COM    = 60;
    const COMMENT_COM = 250;
    const POST_COM    = 350;
    const VIEWS_COM   = 60;

    public function getSocialMedia(): string
    {
        return Str::ucfirst($this->social_media);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'ticket_id');
    }

    public function getCommissionFee()
    {
        return "Rp" . $this->commission . " / " . $this->type;
    }

    public function getTicket()
    {
        return $this->amount ?: "Tiket Habis";
    }

    public function getTotalPayment()
    {
        return $this->getFormatedPrice($this->package()->first()->price * $this->views);
    }

    public function alreadyGetTicket($adsId)
    {
        return Ticket::where([['ads_id', $adsId], ['user_id', auth()->user()->id]])->first();
    }

    public function getFormatedPrice($attr)
    {
        return 'Rp' . number_format($attr, 0, ',', '.');
    }

}
