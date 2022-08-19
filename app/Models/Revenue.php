<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_id',
        'type',
        'amount',
        'is_transferred',
    ];

    const TICKET   = "ticket";
    const REFERRAL = "referral";

    public function getAmount()
    {
        return 'Rp' . number_format($this->amount, 0, ',', '.');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isTransfered()
    {
        return $this->is_transferred ? "Sudah" : "Belum";
    }
}
