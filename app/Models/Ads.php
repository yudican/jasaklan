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

    protected $appends = ['youtube_id'];

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
        return $this->hasMany(Ticket::class);
    }

    public function getCommissionFee($type = 'views')
    {
        return "Rp" . $this->package->commission . " / " . $this->type;
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

    /**
     * Get the user that owns the Ads
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The ads that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function userViews()
    {
        return $this->belongsToMany(User::class, 'ads_user', 'ads_id', 'user_id');
    }

    public function getYoutubeIdAttribute()
    {
        $url = $this->url;
        if ($url) {
            $urls = explode("/embed/", $url);
            if (count($urls) > 1) {
                return $urls[1];
            }
            $urls = explode("/watch?v=", $url);
            if (count($urls) > 1) {
                return $urls[1];
            }
            $urls = explode("/shorts/", $url);
            if (count($urls) > 1) {
                $params = explode("?", $urls[1]);
                if (count($params) > 1) {
                    return $params[0];
                }
                return $urls[1];
            }

            $urls = explode("youtu.be/", $url);
            if (count($urls) > 1) {
                return $urls[1];
            }
            return null;
        }
        return null;
    }
}
