<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use HasFactory;

    protected $table = 'order_histories';

    protected $fillable = [
        'order_id',
        'user_id',
        'status',
    ];

    public static function list()
    {
        return OrderHistory::join('users', 'order_histories.user_id', 'users.id')
                    ->select('users.id', 'users.firstName', 'users.middleName', 'users.lastName', 'order_histories.order_id', 'order_histories.status', 'order_histories.created_at')
                    ->get();
    }
}
