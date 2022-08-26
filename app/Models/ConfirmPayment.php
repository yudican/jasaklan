<?php

namespace App\Models;

use App\Models\Traits\HandleUpload;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfirmPayment extends Model
{
    //use Uuid;
    use HasFactory, HandleUpload;

    //public $incrementing = false;

    protected $fillable = ['user_id', 'nominal', 'bank_asal', 'bank_tujuan', 'bank_nama_rekening', 'bank_bukti_transfer', 'status'];

    protected $dates = [];

    public function imageAttribute(): string
    {
        return 'bank_bukti_transfer';
    }

    public function getImagePath(): string
    {
        return '';
    }
}
