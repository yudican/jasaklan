<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['balance', 'username', 'name', 'email', 'phone', 'address', 'city', 'state', 'postal_code', 'active'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const MINIMUM_DEPOSIT = 100000;

    public function setUsernameAttribute($attribute)
    {
        $this->attributes['username'] = Str::slug($attribute) . rand(0, 99);
    }

    public function getReferralUrl(): string
    {
        return url('ref/' . $this->username);
    }

    public function getBalance(): string
    {
        return (new Transaction())->getFormattedPrice($this->balance);
    }

    public function getShareOnWa(): string
    {
        return "whatsapp://send?text=" . $this->getReferralUrl();
    }

    public function getShareOnFb(): string
    {
        return "https://www.facebook.com/sharer/sharer.php?u=" . $this->getReferralUrl();
    }

    public function getShareOnTwitter(): string
    {
        return "http://twitter.com/share?url=" . $this->getReferralUrl();
    }

    public function getShareOnLinkedIn(): string
    {
        return "https://www.linkedin.com/shareArticle?url=" . $this->getReferralUrl();
    }

    public function getShareOnEmail(): string
    {
        return "mailto:?body=" . $this->getReferralUrl();
    }

    public function setPasswordAttribute($attribute)
    {
        $this->attributes['password'] = Hash::needsRehash($attribute) ? Hash::make($attribute) : $attribute;
    }

    public function referredBy(): HasMany
    {
        return $this->hasMany(Referral::class, 'user_id');
    }

    public function myReferrals(): HasMany
    {
        return $this->hasMany(Referral::class, 'referred_by_id');
    }

    public function getBank(): HasOne
    {
        return $this->hasOne(Bank::class, 'user_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }

    public function getAds(): HasMany
    {
        return $this->hasMany(Ads::class, 'user_id');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'user_id');
    }

    public function revenues(): HasMany
    {
        return $this->hasMany(Revenue::class, 'user_id');
    }

    /**
     * Get all of the balances for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function balances()
    {
        return $this->hasMany(Balance::class);
    }

    public function getBalanceAttribute()
    {
        return $this->balances()->whereStatus(1)->sum('amount');
    }

    /**
     * The ads that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function adViews()
    {
        return $this->belongsToMany(Ads::class, 'ads_user', 'user_id', 'ads_id');
    }
}
