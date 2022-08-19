<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'status',
    ];

    protected $attributes = [
        'status' => self::PENDING,
    ];

    const PENDING = "pending";
    const SETTLE = "settlement";
    const FAIL = "failed";

    const INCOME = "income";
    const EXPENSES = "expenses";
    const WITHDRAW = "withdraw";

    public function getAmount(): string
    {
        return $this->getFormattedPrice($this->amount);
    }

    public function getFormattedPrice($attribute): string
    {
        return "Rp" . number_format($attribute, '0', ',', '.');
    }
}
