<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    //use Uuid;
    use HasFactory;

    //public $incrementing = false;

    protected $fillable = ['ads_type_id', 'social_media_name', 'social_media_status'];

    protected $dates = [];


    /**
     * Get the adsType that owns the SocialMedia
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adsType()
    {
        return $this->belongsTo(AdsType::class)->whereNotNull('updated_at');
    }
}
