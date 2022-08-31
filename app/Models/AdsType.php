<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsType extends Model
{
    //use Uuid;
    use HasFactory;

    //public $incrementing = false;

    protected $fillable = ['type_name', 'type_action', 'updated_at'];

    protected $dates = [];

    /**
     * Get all of the ads for the AdsType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function packages()
    {
        return $this->hasMany(Packages::class)->whereNotNull('packages.updated_at');
    }

    /**
     * Get all of the socialMedia for the AdsType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function socialMedia()
    {
        return $this->hasMany(SocialMedia::class);
    }
}
