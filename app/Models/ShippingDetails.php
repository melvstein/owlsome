<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingDetails extends Model
{
    use HasFactory;

    protected $table = 'shipping_details';

    protected $fillable = [
        'user_id',
        'order_id',
        'receiver',
        'contactNumber',
        'address',
        'city',
    ];
}
