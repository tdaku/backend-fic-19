<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AddressBuyer;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'seller_id',
        'address_id',
        'total_price',
        'shipping_price',
        'grand_total',
        'status',
        'payment_va_number',
        'payment_va_name',
        'shipping_service',
        'shipping_number',
        'transaction_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class);
    }

    public function addressesBuyer()
    {
        return $this->belongsTo(AddressesBuyer::class);
    }

}
