<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank_id',
        'amount',
        'status',
    ];

    protected $attributes = [
        'status' => self::PENDING,
    ];


    const SETTLE  = "settlement";
    const PENDING = "pending";
    const FAILED  = "failed";

    const MINIMUM_WITHDRAW = 250000;
}
