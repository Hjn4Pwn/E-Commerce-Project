<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'transaction_no',
        'response_code',
        'amount',
        'bank_code',
        'pay_date',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
