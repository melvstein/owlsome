<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalEarning extends Model
{
    use HasFactory;

    protected $table = 'total_earnings';

    protected $fillable = [
        'order_id',
        /* 'item_name',
        'quantity', */
        'shipping_fee',
        'amount',
        'earned',
    ];

    public static function list()
    {
        return TotalEarning::orderBy('created_at', 'desc')->get();
    }

    public static function totalEarned()
    {
        $totalEarnings = TotalEarning::orderBy('created_at', 'desc')->get();

        $totalEarned = 0;

        foreach($totalEarnings as $data)
        {
            $totalEarned += $data->earned;
        }

        return $totalEarned;
    }
}
