<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityShippingFee extends Model
{
    use HasFactory;

    protected $table = "cities_shipping_fee";

    protected $fillable = [
        'city',
        'shipping_fee',
    ];

    public static function list()
    {
        return CityShippingFee::all();
    }

    public static function fee()
    {
        return CityShippingFee::where('city', auth()->user()->city)
                    ->select('shipping_fee')
                    ->get();
    }
}
